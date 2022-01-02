<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePriceForPublicPrivaterders extends FormRequest
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
            // 'provider_id'=>'required',
            'order_id'=>'required',
            'price'=>'required|numeric',
            'notes'=>'string',
            'viewing_price'=>'boolean'
        ];
    }
}
