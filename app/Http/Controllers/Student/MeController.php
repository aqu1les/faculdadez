<?php

namespace App\Http\Controllers\Student;

use App\Entities\Course;
use App\Entities\Student;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;

class MeController extends ApiController
{
    public function me()
    {
        return $this->success(Auth::user()->getCurrentSemesterInfo());
    }

    public function schoolRecord()
	{
		return $this->success(Auth::user()->getSchoolRecord());
	}
}
