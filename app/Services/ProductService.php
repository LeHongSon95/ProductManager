<?php

namespace App\Services;

use App\Http\Controllers\Admin;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;

class ProductService
{
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id

     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $check = Product::where('id', $id)->delete();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Upload from storage.
    *
    * @param \App\Http\Requests\ProductCreateRequest $request

    * @return string|false
    */
    public function upload(ProductCreateRequest $request)
    {

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move('upload/user', $filename);
            return $filename;
        }
        return false;
    }
}
