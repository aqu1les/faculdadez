<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => 'required|size:11',
			'password' => 'required|min:5',
        ];
    }
	public function messages()
	{
		return [
			'cpf.required' => 'A CPF field is required',
			'cpf.size' => 'CPF must have 11 characters',
			'password.required' => 'The password field is required',
			'password.min' => 'Password must have at least 5 characters',
		];
	}
}
