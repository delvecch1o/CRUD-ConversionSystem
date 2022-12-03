<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinRequest extends FormRequest
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
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:usd,eur,brl|different:submitTo',
            'submitTo' => 'required|string|in:usd,eur,brl'
        ];
        
    }
}


