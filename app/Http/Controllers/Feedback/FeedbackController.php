<?php

namespace App\Http\Controllers\Feedback;

use App\Entities\Feedback;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends ApiController
{
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			"name" => "required",
			"email" => "email",
			"message" => "required"
		]);

		if ($validator->fails()) {
			return $this->unprocessable(["error"=>$validator->errors()]);
		}

		Feedback::create($request->all());

		return $this->success(["msg" => "Feedback successfully stored"]);
	}
}
