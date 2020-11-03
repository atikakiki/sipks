<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function loginIndex(){
        return view('auth.login');
    }

    public function registerIndex(){
        return view('auth.register');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function postLogin(Request $request){
        if(Auth::attempt([
          'email' => $request->email,
          'password' => $request->password
        ], $request->remember)){
          return redirect('/dashboard')->with('success','Login sukses');
        }
  
        else return redirect('/')->with('error','Username / Password salah');
      }
}