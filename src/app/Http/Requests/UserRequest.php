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
        return true;
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
            'cpf' => 'string|required|cpf'    
        ];
        if ($this->method() != 'PUT') {
            $rules['password'] = 'string|min:6|required';
            $rules['email'] .= '|unique:users';
        } else{
            $rules['password'] = 'string|min:6|nullable';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'cpf.cpf' => 'Invalid CPF'
        ];
    }
}
