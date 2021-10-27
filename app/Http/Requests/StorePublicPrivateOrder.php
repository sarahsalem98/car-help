<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePublicPrivateOrder extends FormRequest
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
            'car_id'=>'required|exists:cars,id',
            'details'=>'required',
            'images'=>'required',
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
            'order_type'=>'required|numeric'

        ];
    }
}
