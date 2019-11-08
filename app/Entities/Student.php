<?php

namespace App\Entities\Models;

use App\Entities\Models\Course;
use App\Entities\Models\Discipline;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "cpf", "password", "current_semester", "course_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $appends = ["course"];

    public function course()
        {
        return $this->belongsTo(Course::class, "course_id", "id");
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, "students_disciplines")->withPivot("final_average", "status");
    }

    public function getCourseAttribute()
    {
        return $this->course()->getResults();
    }
}

