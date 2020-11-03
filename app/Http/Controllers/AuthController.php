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


    public function postRegister(Request $request){
          // $rules = [
          //   'username' => 'required',
          //   'firstname' => 'required',
          //   'lastname' => 'required',
          //   'password' => 'required',
          //   'intake_code' => 'required',
          //   'email' => 'required|email',
          //   'img' => 'mimes:jpeg,jpg,png,bmp'
          // ];

          // dd($request->all());

          // $validator = Validator::make($request->all(),$rules);
          // if($validator->fails()){
          //   return redirect('/register')->withErrors($validator)->withInput();
          // }

          $check = User::where('email',$request->email)->first();

          if($check) return back()->with('error','Username has been taken.'); //username check

          try {
            $newUser = new User();
            $newUser->fullname = $request->firstname.' '.$request->lastname;
            $newUser->email = $request->email;
            $newUser->username = $request->username;
            $newUser->intake_code = $request->intake_code;
            $newUser->password = bcrypt($request->password);
            $newUser->level = 1;

            // if($request->file('img') != NULL){
            //   $picture = $request->file('img');
            //   $newUser->picture = 'uploads/avatar/'.$newUser->username.'.'.$picture->getClientOriginalExtension();
            //   $picture->move('uploads/avatar/',$newUser->picture);
            // }

            $newUser->save();
          } 
          catch (\Exception $e) {
            $newUser->delete();
           return $e->getMessage();
          }

          return redirect('/')->with('success','Account created.');

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