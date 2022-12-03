<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
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
        
        $action = $this->route()->getActionMethod();

        if (! method_exists($this, $action)) {
            return [];
        }

        return $this->{$action}();

    }

    public function register()
    {
        return [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];

    }

    public function login()
    {
        return [
            'email' => 'required|max:191',
            'password' => 'required',
        ];
    }

    
    
}


