<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRegister extends FormRequest
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
            'workshop_photo_path'=>'required',
            'workshop_name'=>'required|string',
            'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'enginner_name'=>'required',
            'phone_number'=>'required|numeric|unique:providers',
            'whatsapp_number'=>'required|numeric',
            'email'=>'required|email',
            'password'=>'required',
            'business_registeration_file'=>'required',
            'agreed'=>'required|in:1',
            'phone_number_without_country_code'=>'required',
            'country_code_name'=>'required',
            'device_token'=>'string'
        ];
    }
}
