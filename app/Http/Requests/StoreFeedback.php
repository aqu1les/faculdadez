<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedback extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'name' => 'required',
			'email' => 'email|required',
			'message' => 'required'
        ];
    }
    public function messages()
	{
		return [
			'name.required' => 'A name is required',
			'email.email' => 'E-mail field must be a valid e-mail',
			'email.required' => 'E-mail field is required',
			'message.required' => 'The message field is required',
		];
	}

}
