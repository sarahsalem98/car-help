<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProviderUpdate extends FormRequest
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
            'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'phone_number'=>'unique:providers',
            'whatsapp_number'=>'numeric',
            'email'=>'email',
            'business_registeration_file'=>'mimes:pdf,doc,docx',
            'enginner_name'=>'string',
            'workshop_name'=>'string',
            'password'=>'string',
            'phone_number_without_country_code'=>'',
            'country_code_name',

        ];
    }
}
