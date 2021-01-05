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
use App\Models\FotoWajah;

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

        // public function getprofile (){
        //   $data['profile'] = Auth::user();
        //   return json_encode($data);
        // }

        public function getprofile () {
          $data['profile'] = DB::table('users')->join('sekolah', function($join)
          {
            $join->on('users.id_sekolah', '=', 'sekolah.id_sekolah')
                  ->where('users.id', Auth::user()->id);
          })->get();
          return json_encode($data);
        }

        public function getpengajuan (Request $request){

          // $data['pengajuan'] = Auth::user();

          if(Auth::user()->role_akun=='1')
          {
            // dd($request->status);
            if($request->status==0)
            {
                 $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
                {
                    $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                          ->where ('users.id', Auth::user()->id);
                })->where('status_pengajuan','0')->orWhere('status_pengajuan','1')->get();
              //   foreach($data['pengajuan'] as $item){
              //     $item->msg = "0";
              // }
            }
            else if($request->status==3){
               $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
              {
                  $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                        ->where ('users.id', Auth::user()->id);

              })->where('status_pengajuan','3')->get();
              // foreach($data['pengajuan'] as $item){
              //   $item->msg = "0";
              // }

            }
            else{
                   $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
                  {
                      $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                            ->where ('users.id', Auth::user()->id);

                  })->where('status_pengajuan','2')->get();
                //   foreach($data['pengajuan'] as $item){
                //     $item->msg = "1";
                // }
            }

          }

          else
          {
            if($request->status==0)
            {
                 $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
                {
                    $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                          ->where ('users.id', Auth::user()->id);

                })->where('status_pengajuan','0')->get();
              //   foreach($data['pengajuan'] as $item){
              //     $item->msg = "0";
              // }
            }
            else if($request->status==3)
            {
               $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
              {
                  $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                        ->where ('users.id', Auth::user()->id);

              })->where('status_pengajuan','3')->get();
              // foreach($data['pengajuan'] as $item){
              //   $item->msg = "0";
            // }
            }
            else{
                   $data['pengajuan'] = DB::table('Pengajuan')->join('users', function ($join)
                  {
                      $join->on('Pengajuan.id_sekolah', '=', 'Users.id_sekolah')
                            ->where ('users.id', Auth::user()->id);

                  })->where('status_pengajuan','1')->orWhere('status_pengajuan','2')->get();
                //   foreach($data['pengajuan'] as $item){
                //     $item->msg = "1";
                // }
            }
          }
           return json_encode($data);
        }

        public function getdetail($id){

          if(Auth::user()->role_akun=='1')
          {
            $data['detailpeng'] = DB::table('Pengajuan')
                                            ->join('mapping_pengajuan_detail','pengajuan.id_pengajuan','=', 'mapping_pengajuan_detail.id_pengajuan')
                                            ->join('detail_pengajuan', 'detail_pengajuan.id_detail', '=', 'mapping_pengajuan_detail.id_detail')
                                            ->where('mapping_pengajuan_detail.id_pengajuan',$id)
                                            ->get();
             foreach($data['detailpeng'] as $item){
                    if($item->status_pengajuan == "1"){
                      $item->msg = "1";
                    }
                    else{
                      $item->msg = "0";
                    }
              }
            return json_encode($data);
          }
          else
          {
            $data['detailpeng'] = DB::table('Pengajuan')
                                            ->join('mapping_pengajuan_detail','pengajuan.id_pengajuan','=', 'mapping_pengajuan_detail.id_pengajuan')
                                            ->join('detail_pengajuan', 'detail_pengajuan.id_detail', '=', 'mapping_pengajuan_detail.id_detail')
                                            ->where('mapping_pengajuan_detail.id_pengajuan',$id)
                                            ->get();
             foreach($data['detailpeng'] as $item){
                    if($item->status_pengajuan == "0"){
                      $item->msg = "1";
                    }
                    else {
                      $item->msg = "0";
                    }
              }
            return json_encode($data);
          }

          
        }


        public function tolakPengajuan (Request $request){
          $data = Pengajuan::where('id_pengajuan',$request->id)->first();
          $data->status_pengajuan = $request->status;
          $data->save();
          return json_encode(['status'=>'OK']);
        }


}