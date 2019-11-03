<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"], function() {
    Route::post("login", "AuthController@login");
    Route::post("register", "AuthController@register");
});

Route::group(["middleware" => "auth:api"], function() {

    Route::group(["prefix" => "students"], function () {
        Route::get("", "Student\StudentController@index");
        Route::get("/{id}", "Student\StudentController@show");
    });

    Route::group(["prefix" => "courses"], function () {
        Route::get("", "Course\CourseController@index");
        Route::post("", "Course\CourseController@store");
        Route::get("/{id}", "Course\CourseController@show");
    });
});
