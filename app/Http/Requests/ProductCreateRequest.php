<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'stock' => 'required|numeric|min:0|max:10000',
            'avatar_tmp' => 'image|mimes:jpg,png,jpeg|max:3MB',
            'expired_at' => 'nullable|date|after:' . \Carbon\Carbon::now(),// 2 thằng này k ăn nè, đang lỗi chỗ này, hình như do try catch
            'sku' => 'required|regex:/^[\s\w-]*$/',
            'category_id' => 'required|numeric',
        ];
    }
}
