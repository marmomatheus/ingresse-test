<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [            
            'name' => 'string|required|max:191',          
            'email' => 'email|required',      
            'cpf' => 'string|required|max:11'    
        ];
        if ($this->method() != 'PUT') {
            $rules['email'] .= '|unique:users';
            $rules['password'] = 'string|min:6|nullable';
        } else{
            $rules['password'] = 'string|min:6|required';
        }
        return $rules;
    }
}