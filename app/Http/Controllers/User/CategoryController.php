<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CreateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(10);
        return view('admin.category.category', ['data' => $category])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {;
        try {
            $result = Category::select('id', 'name', 'parent_id')
                ->whereNull('parent_id')
                ->get();

            return view('admin.category.create', compact('result'));
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $create = Category::create([
                'name' => $data['name'],
                'parent_id' => $data['parent_id']
            ]);
            if ($create) { // mặc dịnh là true
                DB::commit();
                return redirect()->route('category.index');
            }
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
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
        //
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
            $data = Category::findOrFail($id)->load('parent'); //load trả về 1 đối tượng

            $result = Category::select('id', 'name', 'parent_id')
                ->whereNull('parent_id')
                ->get();
           
            return view('admin.category.edit', compact('data', 'result'));
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Category::findOrFail($id);

            $request = collect($request)->toArray();
            if ($data->update($request)) {
                DB::commit();
                return redirect()->route('category.index');
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
            $check = Category::where('id', $id)->delete();
            if ($check) {
                DB::commit();
                return redirect()->route('category.index');
            } else {
                DB::commit();
                return $check;
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
