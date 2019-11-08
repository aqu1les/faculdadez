<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ["name", "total_semesters"];

    protected $hidden = ["created_at", "updated_at"];

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, "disciplines_courses")->withPivot("semester");
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function getDisciplinesAttribute()
    {
        return $this->disciplines()->getResults();
    }
}
