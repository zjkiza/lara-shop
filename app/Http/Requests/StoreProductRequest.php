<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:1000',
            'status' => 'required',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0.01',
            'manufacturer_id' => 'required',
            'category_id' => 'required',
        ];
    }
}
