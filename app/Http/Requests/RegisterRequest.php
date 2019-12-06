<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name' => 'required',
			'cpf' => 'required|size:11|unique:students',
			'password' => 'required|confirmed|min:5',
			'registration' => 'required|unique:students'
		];
	}
	public function messages()
	{
		return [
			'name' => 'A name is required',
			'cpf.required' => 'A CPF field is required',
			'cpf.size' => 'CPF must have 11 characters',
			'cpf.unique' => 'User already registered',
			'password.required' => 'The password field is required',
			'password.min' => 'Password must have at least 5 characters',
			'password.confirmed' => 'Password must be confirmed',
			'registration.required' => 'The registration field is required',
			'registration.unique' => 'User already registered',
		];
	}
}
