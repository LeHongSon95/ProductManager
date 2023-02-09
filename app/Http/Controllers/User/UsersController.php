<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Jobs\SendMailUser;
use App\Mail\MailUser;
use App\Models\Commune;
use App\Models\District;
use App\Models\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     *@return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::select('id', 'user_name', 'avatar', 'email', 'birtday', 'flag_delete', 'province_id', 'commune_id', 'district_id')
                ->with('province')
                ->get();
            return view('admin.user.user', ['data' => $user]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::all();

        return view('admin.user.create', compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move('upload/user', $filename);
                $data['avatar'] = $filename;
            }
            $createUser = User::create([
                'user_name' => $data['user_name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'avatar' => $data['avatar'] ?? '',
                'birtday' => $data['birtday'],
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'commune_id' => $data['commune_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            $testMail = new MailUser();
            $sendEmailJob = new SendMailUser($testMail);
            dispatch($sendEmailJob);
            if ($createUser) { // mặc dịnh là true
                DB::commit();
                return redirect()->route('user.index')->withSuccess("Success");
            }
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            echo 'Hi';
        }
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = User::find($id)->load('province');
            $province = Province::all();

            if (!empty($data)) {
                return view('admin.user.edit', compact('data', 'province'));
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $arr = $request->all();
            $data = User::find($id);
            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/user'), $filename);
            }
            $testMail = new MailUser();
            $sendEmailJob = new SendMailUser($testMail);
            dispatch($sendEmailJob);

            if ($filename) {
                $arr['avatar'] = $filename;
            }
            $data->update($arr);

            if ($data) {
                DB::commit();
                return redirect()->route('user.index');
            } else {
                DB::commit();
                return redirect()->back();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $check = User::where('id', $id)->delete();

            if ($check) {
                DB::commit();
                return response()->json([
                    'message' => 'Delete',

                ], 200);
            } else {
                DB::commit();
                return response()->json([
                    'message' => 'Error',
                ], 404);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Add district
     *
     * 
     * @param int $id

     * @param \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response
     */
    public function district(Request $request)
    {
        try {
            $district = District::where('province_id', $request->province_id)->get();

            if (count($district) > 0) {
                return response()->json($district);
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Add commune
     *
     * @param int $id

     * @param \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response
     */
    public function commune(Request $request)
    {
        try {
            $commune = Commune::where('district_id', $request->district_id)->get();
            if (count($commune) > 0) {
                return response()->json($commune);
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                return view('admin.product.orderDetail',  ['data' => $order]);
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPDF($id)
    {
        $data = Order::find($id);
        $pdf = PDF::loadView('admin.product.showPDF',  compact('data'));
        return $pdf->download('pdf_file.pdf');
    }
}
