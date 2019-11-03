<?php

namespace App\Http\Controllers\Course;

use App\Entities\Models\Course;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CourseController extends ApiController
{
    /**
     * CourseController constructor.
     *
     * Defines the model to the ApiController
     */
    public function __construct()
    {
        $this->model = Course::class;
    }
}
