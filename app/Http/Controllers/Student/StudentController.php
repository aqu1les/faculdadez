<?php

namespace App\Http\Controllers\Student;

use App\Entities\Models\Student;
use App\Entities\Models\Teacher;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends ApiController
{
    /**
     * StudentController constructor.
     *
     * Defines the model to the ApiController
     */
    public function __construct()
    {
        $this->model = Student::class;
    }
}
