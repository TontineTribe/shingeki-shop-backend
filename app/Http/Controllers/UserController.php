<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{       
  public function store(CreateUserRequest $request){
    try{
      $data = $request->validated();
      $password = $data['password'];
      $data['password'] = Hash::make($password);
      $user = User::create($data);
      return response()->json([
        'success' => true,
        'status' => 200,
        'message' => 'User created successfully',
        'user' => $user
      ]);
    }catch(\Exception $e){
      return response()->json($e);
    }  
  }

  public function login(LoginRequest $request): JsonResponse{
    try{
      $email = $request->validated('email');
      $password = $request->validated('password');
      $remember = $request->validated('remember_checkbox');
      if(Auth::attempt(['email'=>$email , 'password' => $password],$remember)){
        $user = Auth::user();
        $token = $user->createToken("$12$9.16sYCB01d5kam8uy/k5Opu9DCMh4wSryHKI1s4jbODe6W1i6kwa")->plainTextToken;
        return response()->json([
          'status' => 200,
          'message' => "user connected",
          "user" => $user,
          "token" => $token
        ],200);
      }else{
        return response()->json([
          'status' => 403,
          'message' => "connection credentials invalid"
        ],403);
      }
    }catch(\Exception $e){
      return response()->json($e);
    }  
  }

  
  public function logout(): JsonResponse{
    try{
      Auth::user()->tokens()->delete();
      return response()->json([
        'status' => 200,
        'message' => "user disconnected"
      ],200);
    }catch(\Exception $e){
      return response()->json($e);
    }  
  }
}
