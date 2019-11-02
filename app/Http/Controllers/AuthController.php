<?php

namespace App\Http\Controllers;

use App\Student;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $unauthorizedStatus = 401;

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        if(Auth::attempt(["cpf" => $request->cpf, "password" => $request->password])) {
            $user = Auth::user();
            $success["token"] = $user->createToken("FaculdadeZ")->accessToken;

            return response()->json(["success" => $success], $this->successStatus);
        } else {
            return response()->json(["error" => "Unauthorized"], $this->unauthorizedStatus);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "cpf" => "required",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ]);
        if ($validator->fails()) {
            return response()->json(["error"=>$validator->errors()], $this->unauthorizedStatus);
        }
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = Student::create($input);
        $success["token"] =  $user->createToken("FaculdadeZ")-> accessToken;
        $success["name"] =  $user->name;
        return response()->json(["success"=>$success], $this-> successStatus);
    }
}
