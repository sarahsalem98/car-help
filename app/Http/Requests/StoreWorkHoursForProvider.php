<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWorkHoursForProvider extends FormRequest
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
            'closed'=>'required',
            'day'=>'required|max:20',
            'from'=>'required_if:closed,==,0|date_format:H:i',
            'to'=>'required_if:closed,==,0|date_format:H:i|after:from'
        ];
    }
}
