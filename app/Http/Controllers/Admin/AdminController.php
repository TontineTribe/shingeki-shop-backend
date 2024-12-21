<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){
      return view('admin.formulaire');
    } 
    function doLogin(LoginRequest $request){
      $name = $request->validated('name');
      $password = $request->validated('password');
      $remember = $request->validated('remember_checkbox');

      if(Auth::guard('admin')->attempt(['name'=>$name , 'password' => $password],$remember)){
          $request->session()->regenerate();
          return redirect()->intended(route('admin.product.index'));
      }
      return redirect()->route('notAuthorize');
  }
  function logout(){
      Auth::guard('admin')->logout();
      return redirect()->route('myhome.product')->with('success','Vous etes maintenant deconnecter');
  }
}
