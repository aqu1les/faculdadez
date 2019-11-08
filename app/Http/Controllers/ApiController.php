<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use ApiResponse, ValidatesRequests;

    protected $model;

    public function index()
    {
        return $this->success($this->model::all());
    }
    public function show(int $id)
    {
        return $this->success($this->model::findOrFail($id));
    }
    public function store() {}
    public function update() {}
    public function delete() {}
}
