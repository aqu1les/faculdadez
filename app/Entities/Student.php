<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = ["name", "cpf", "password", "current_semester", "course_id"];

    protected $hidden = ["password", "course_id", "created_at", "updated_at"];

    public function course()
    {
        return $this->belongsTo(Course::class, "course_id", "id");
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, "students_disciplines")->withPivot("final_average", "status");
    }

    public function getDisciplinesAttribute()
    {
        return $this->disciplines()->getResults();
    }

	public function getCourseAttribute()
	{
		return $this->course()->getResults();
	}
}

