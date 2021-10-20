<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'category_id'=>'required',
        'name'=>'required|max:255',
        'details'=>'required',
        'price'=>'required|numeric',
        'price_after_discount'=>'required|numeric',
        'qty'=>'required|numeric',
        'images'=>'required',
        'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
