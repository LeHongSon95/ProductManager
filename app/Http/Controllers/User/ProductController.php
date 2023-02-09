<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use Alert;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisneyplusExport;
use Illuminate\Http\Request;
use Domppdf\Domppdf;
use App\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $product = Product::select('category_id','price', 'name', 'sku', 'stock', 'avatar', 'expired_at', 'id');

            $key = request()->key;
            if ($key) {
                $product = Product::whereHas('product_catelory', function ($query) use ($key) {
                    $query->where('name', 'like', '%' .  $key . '%');
                })->orWhere('name', 'like', '%' . $key . '%');
            }
            $count = request()->count;

            if ($count == 10) {
                $product = $product
                    ->where('stock', '<', 10);
            } else if ($count === "10-100") {
                $product = $product
                    ->whereBetween('stock', [10, 100]);
            } else if ($count === '101-200') {
                $product = $product
                    ->whereBetween('stock', [101, 200]);
            }

            $product = $product
                ->with('product_catelory')
                ->paginate(10);
            return view('admin.product.product', compact('product'))->with('i', (request()->input('page', 1) - 1) * 10);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id', 'name')
            ->get();
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        DB::beginTransaction();
        try {

            $avatar = $this->productService->upload($request);
            if (!empty($avatar)) {
                $data['avatar'] = $avatar;
            }

            $create = Product::create([
                'name' => $data['name'],
                'sku' => $data['sku'],
                'stock' => $data['stock'],
                'avatar' => $data['avatar'],
                'expired_at' => $data['expired_at'],
                'category_id' => $data['category_id'],
            ]);
            if ($create) { // mặc dịnh là true
                Alert::success('Success Title', 'Success Message');
                DB::commit();
                return redirect()->route('product.index', compact('data'))->withSuccess("Success");
            }

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
        try {
            $product = Product::with('product_catelory')
                ->where('id', $id)
                ->get();
            DB::commit();
            return view('admin.product.detail', ['data' => $product]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
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
            $data = Product::find($id)->load('product_catelory');
            if (empty($data)) {
                Alert::error('Error Title', 'Error Message');
                return redirect()->back();
            }
            $category = Category::select('id', 'name')
                ->get();

            return view('admin.product.edit', compact('data', 'category'));
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
    public function update(ProductCreateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Product::find($id);

            if ($request->file('avatar_tmp')) {
                $file = $request->file('avatar_tmp');
                $newname = date('YmdHi') . $file->getClientOriginalName();
                $file->move('upload/product', $newname);
                $request['avatar'] = $newname;
                $oldimage = $data->avatar;
                File::delete('upload/product/' . $oldimage);
            }
            $request = collect($request)->toArray(); // collect lấy những thứ trong input đó

            if ($data->update($request)) {
                DB::commit();
                return redirect()->route('product.index');
            }
            DB::commit();
            return redirect()->back();
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
            $check =  $this->productService->destroy($id);

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
     * Create Excel
     *
     * 
     * @return mixed
     */

    public function export()
    {
        return Excel::download(new DisneyplusExport, 'note.csv');
    }

    /**
     * Create PDF
     *
     * 
     * @return mixed
     */
    public function createPDF()
    {
        try {
            $data = Product::select('id', 'name', 'stock', 'expired_at', 'category_id', 'sku')
                ->get();
            $pdf = PDF::loadView('admin.product.createPDF', compact('data'));
            return $pdf->download('pdf_file.pdf');
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function order(){
        
    }
}
