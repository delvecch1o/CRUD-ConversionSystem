<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemperatureRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:celsius,fahrenheit,kelvin|different:submitTo',
            'submitTo' => 'required|string|in:celsius,fahrenheit,kelvin'
        ];
    }
}
