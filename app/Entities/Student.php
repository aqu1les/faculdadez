<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = ['name', 'cpf', 'password', 'current_semester', 'course_id', 'registration'];

    protected $hidden = ['password', 'course_id', 'created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'students_disciplines')->withPivot('final_average', 'status');
    }

    public function getDisciplinesAttribute()
    {
        return $this->disciplines()->getResults();
    }

	public function getCourseAttribute()
	{
		return $this->course()->getResults();
	}

	public function getCurrentSemesterInfo()
	{
		$course = $this->course;
		$course['disciplines'] = $this->getCurrentDisciplines();
		return [
			'id' => $this->id,
			'name' => $this->name,
			'cpf' => $this->cpf,
			'registration' => $this->registration,
			'current_semester' => $this->current_semester,
			'course' => $course
		];
	}

	public function getCurrentDisciplines()
	{
		return $this->course->getSemesterDisciplines($this->current_semester)->getResults();
	}

	public function setPasswordAttribute($value) {
		$this->attributes['password'] = Hash::make($value);
	}

	public function getSchoolRecord()
	{
		return [
			'id' => $this->course->id,
			'name' => $this->course->name,
			'total_semesters' => $this->course->total_semesters,
			'disciplines' => $this->separateDisciplinesBySemester()
		];
	}

	private function separateDisciplinesBySemester()
	{
		$semesters = [];
		for($i = 0; $i < $this->course->total_semesters; $i++) {
			$semesters[$i] = [];
		}
		foreach($this->disciplines as $discipline) {
			$discipline['grade'] = $discipline->pivot;
			unset($discipline['pivot']);
			$discipline['semester'] = $discipline->getSemesterByCourse($this->course->id)->semester;
			array_push($semesters[$discipline['semester'] - 1], $discipline);
		}
		return $semesters;
	}
}

