<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\String\u;

class AdminAuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('admin.auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
           
            return redirect()->route('dashboard.admin')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect()->route("login.admin")->withSuccess('Oppes! You have entered invalid credentials');
    }
    /**
     * Write code on Method
     * 
     * @param array $data
     *
     * @return response()
     */
    public function create(array $data)
    {

        return User::create([
            'user_name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     * 
     *@param \Illuminate\Http\Request $request
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect()->route("dashboard.admin")->withSuccess('Great! You have Successfully loggedin');
    }



    /**
     * Write code on Method
     * 
     * 
     *
     * @return response()
     */
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }



    /**
     * Write code on Method
     * 
     * 
     *
     * @return response()
     */
    public function logout()
    {
        DB::beginTransaction();
        try {
            Session::flush();
            Auth::guard('admin')->logout();

            DB::commit();
            return Redirect()->route('login.admin');
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}
