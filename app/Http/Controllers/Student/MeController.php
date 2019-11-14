<?php

namespace App\Http\Controllers\Student;

use App\Entities\Course;
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

	public function __construct()
	{
		$this->model = Student::class;
	}

	public function getUserCourse()
	{
		return Course::where("id", "=", Auth::user()["course_id"])->first();
	}

    public function me()
    {
    	$user =  Auth::user();
		$course = $this->getUserCourse();
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
		$disciplinesWithGrades = Auth::user()->with("disciplines")->first()->disciplines;
		$course = $this->getUserCourse();
		$semesters = [];

		// Creates the array of disciplines separating them by the semester
		for($i = 0; $i < $course->total_semesters; $i++) {
			$semesters[$i] = [];
		}

		foreach($disciplinesWithGrades as $discipline) {
			$courseWithDiscipline = $course->disciplines()->wherePivot("discipline_id", "=", $discipline->id)->first();
			$courseWithDiscipline["grade"] = $discipline->pivot;
			$courseWithDiscipline["semester"] = $courseWithDiscipline->pivot->semester;
			unset($courseWithDiscipline["pivot"]);
			array_push($semesters[$courseWithDiscipline["semester"] - 1], $courseWithDiscipline);
		}

		$schoolRecord = [
			"id" => $course->id,
			"name" => $course->name,
			"total_semesters" => $course->total_semesters,
			"disciplines" => $semesters
		];

		return $this->success($schoolRecord);
	}
}
