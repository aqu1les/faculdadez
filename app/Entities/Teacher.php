<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ["name"];

	protected $hidden = ["created_at", "updated_at"];

    public function discipline()
    {
        return $this->hasOne(Discipline::class);
    }
}
