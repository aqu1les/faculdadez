<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ["name", "total_semesters"];

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, "disciplines_courses")->withPivot("semester");
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
