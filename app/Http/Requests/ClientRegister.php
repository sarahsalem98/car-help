<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegister extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255|alpha',
            'phone_number'=>'required|unique:clients',
            'city_id'=>'exists:cities,id|required',
            'password'=>'required',
            'profile_picture.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
            'phone_number_without_country_code'=>'required',
            'country_code_name'=>'required',
            'device_token'=>'required'
        ];
    }
}
