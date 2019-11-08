<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["name", "email", "message"];
}
