<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'provider_id'=>'exists:providers,id',
            'address_id'=>'string|exists:clients_addresses,id',
            'car_id'=>'required|exists:cars,id',
            'details'=>'required',
             'images'=>'required',
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
            'order_type'=>['required','numeric',Rule::in(['0','1']) ]

        ];
    }
}
