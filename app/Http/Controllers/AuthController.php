<?php

namespace App\Http\Controllers;

use App\Entities\Student;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware("auth:api", ["except" => [
                "login",
                "register"
            ]
        ]);
    }

    /**
     * Login API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt(["cpf" => $request->cpf, "password" => $request->password])) {

            $user = Auth::user();
            $token = $user->createToken("FaculdadeZ")->accessToken;

            return $this->success(["token" => $token]);

        } else {

            return $this->unauthorized(["error" => "Login/Senha inválido."]);

        }

    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "cpf" => "required|unique:students",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ]);

        if ($validator->fails()) {

            return $this->unauthorized(["error"=>$validator->errors()]);

        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = Student::create($input);
        $success["token"] =  $user->createToken("FaculdadeZ")->accessToken;
        $success["name"] =  $user->name;

        return $this->success($success);
    }
}
