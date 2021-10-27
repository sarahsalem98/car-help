<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientUpdate extends FormRequest
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
            'name'=>'max:255|alpha',
            'phone_number'=>'unique:clients',
            'city_id'=>'exists:cities,id',
            'profile_picture.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}