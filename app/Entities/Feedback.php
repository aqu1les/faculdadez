<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["name", "email", "message"];
	protected $table = "feedbacks";
}
