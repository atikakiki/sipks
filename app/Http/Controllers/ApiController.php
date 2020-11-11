<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Client;  
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //
    private $client;
      public function __construct(){
        $this->client = Client::find(2);
      }

    public function login(Request $request){
        	 $request->validate([
            'email' => 'required',
            'password' => 'required'
          ]);
          $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*'
          ];
          $request->request->add($params);
          $proxy = Request::create('oauth/token','POST');
          return Route::dispatch($proxy);
        }

        public function refresh(Request $request){
        	 $request->validate([
            'refresh_token' => 'required'
          ]);
          $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'password' => $request->password,
          ];
          $request->request->add($params);
          $proxy = Request::create('oauth/token','POST');
          return Route::dispatch($proxy);
        }
}
