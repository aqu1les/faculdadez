<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends ApiController
{
    public function me() {
        return $this->success(Auth::user());
    }
}
