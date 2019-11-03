<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ["name"];

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, "teachers_disciplines");
    }
}
