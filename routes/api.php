<?php


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
		Route::get("/me", "Student\MeController@me");
		Route::get("/me/schoolRecord", "Student\MeController@schoolRecord");
	});
});
