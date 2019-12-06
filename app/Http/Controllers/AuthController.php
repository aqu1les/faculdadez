<?php

namespace App\Http\Controllers;

use App\Entities\Student;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

	/**
	 * Login API
	 *
	 * @param LoginRequest $request
	 * @return JsonResponse
	 */
    public function login(LoginRequest $request)
    {
    	$credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('FaculdadeZ')->accessToken;
            return $this->success(['token' => $token]);
        } else {
            return $this->unauthorized(['error' => 'Login/Senha inválido.']);
        }
    }

	/**
	 * Register api
	 *
	 * @param RegisterRequest $request
	 * @return JsonResponse
	 */
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $user = Student::create($input);
        $success['token'] =  $user->createToken('FaculdadeZ')->accessToken;
        $success['name'] =  $user->name;

        return $this->success($success);
    }
}
