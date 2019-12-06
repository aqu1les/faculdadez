<?php

namespace App\Http\Controllers\Feedback;

use App\Entities\Feedback;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreFeedback;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends ApiController
{
	public function store(StoreFeedback $request)
	{
		$validated = $request->validated();
		Feedback::create($validated);
		return $this->success(["msg" => "Feedback successfully stored"]);
	}
}
