<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ["name", "difficulty"];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, "teachers_disciplines");
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, "disciplines_courses")->withPivot("semester");
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, "students_disciplines")->withPivot("final_average", "status");
    }
}
