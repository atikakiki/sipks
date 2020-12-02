<?php

namespace App\Http\Controllers;

use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;
use Validator;

use Illuminate\Http\Request;
use Laravel\Passport\Client;  
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\DetailPengajuan;

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

        public function getprofile (){
          $data['profile'] = Auth::user();
          return json_encode($data);
        }

        public function getpengajuan (Request $request){

          // $data['pengajuan'] = Auth::user();

         $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
        {
            $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                  ->where ('users.id', Auth::user()->id);

        })->where('status_pengajuan',$request->status)->get();

           return json_encode($data);
        }

        public function getdetail($id){
          $data['detailpeng'] = DetailPengajuan::where('id_pengajuan',$id)->get();
          // $data['detailpeng'] = DetailPengajuan::get();
          return json_encode($data);
        }

        public function postPengajuan (Request $request){
          $data = Pengajuan::where('id_pengajuan',$request->id)->first();
          $data->status_pengajuan = '1';
          $data->save();
          return json_encode(['status'=>'OK']);
        }

}
