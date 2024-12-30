<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function doLogin(LoginRequest $request){
      $email = $request->validated('email');
      $password = $request->validated('password');
      $remember = $request->validated('remember_checkbox');

      if(Auth::guard('admin')->attempt(['email'=>$email , 'password' => $password],$remember)){
        $user = Auth::guard('admin')->user();
        $token = $user->createToken("$12$9.16sYCB01d5kam8uy/k5Opu9DCMh4wSryHKI1s4jbODe6W1i6kwa")->plainTextToken;
        return response()->json([
          'status' => 200,
          'message' => "admin connected",
          "user" => $user,
          "token" => $token
        ],200);
      }
      return response()->json([
        'status' => 403,
        'message' => "connection admin credentials invalid"
      ],403);
  }
  public function logout():JsonResponse{
    try{
      Auth::user()->tokens()->delete();
      return response()->json([
        'status' => 200,
        'message' => "admin disconnected"
      ],200);
    }catch(Exception $e){
      return response()->json($e);
    }
  }
}
