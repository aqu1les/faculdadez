<?php

namespace App\Http\Controllers\Student;

use App\Entities\Course;
use App\Entities\Discipline;
use App\Entities\Student;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;

class MeController extends ApiController
{
	/**
	 * StudentController constructor.
	 *
	 * Defines the model to the ApiController
	 */

	protected $user;
	public function __construct()
	{
		$this->model = Student::class;
		$this->user = Auth::user();
	}

    public function me()
    {
    	$user = Auth::user();
		$course = Course::where("id", "=", $user["course_id"])->first();
		$course = [
			"id" => $course["id"],
			"name" => $course["name"],
			"total_semesters" => $course["total_semesters"],
			"disciplines" => $course->disciplines()->wherePivot("semester", "=", $user["current_semester"])->get()
		];
		$response = [
			"id" => $user["id"],
			"name" => $user["name"],
			"cpf" => $user["cpf"],
			"registration" => $user["registration"],
			"current_semester" => $user["current_semester"],
			"course" => $course
		];
        return $this->success($response);
    }

    public function schoolRecord()
	{
		return $this->success(Student::with("disciplines")->first());
	}
}
