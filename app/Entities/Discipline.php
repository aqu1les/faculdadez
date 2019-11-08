<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ["name", "difficulty"];

	protected $hidden = ["created_at", "updated_at", "teacher_id"];

	protected $appends = ["teacher"];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, "disciplines_courses")->withPivot("semester");
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, "students_disciplines")->withPivot("final_average", "status");
    }

    public function schedules()
	{
		return $this->hasMany(Schedule::class);
	}

	public function getTeacherAttribute()
	{
		return $this->teacher()->getResults();
	}
}
