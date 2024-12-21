<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{       
    public function store(CreateUserRequest $request){
        // dd($request->validated());
        $data = $request->validated();
        $password = $data['password'];
        $data['password'] = Hash::make($password);
        User::create($data);
        return redirect()->route('login')->with('success','vous avez bien ete enregistrer vous povez desormais vous connecter');
    }
}
