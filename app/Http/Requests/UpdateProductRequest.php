<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|max:255',
            'product_details' => 'required|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'product_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'product_image' => 'sometimes|image',
            'product_status' => 'required|numeric|min:0|max:1',
        ];
    }
}
