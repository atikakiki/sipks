<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
use App\Models\User;

//ytambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;


class DashboardController extends Controller
{
    public function index(){
    	return view('directory.dashboard');
    }

    public function allsekolah(){
        $data['sekolahs'] = Sekolah::get();
    	return view('directory.sekolah',$data);
    }

    public function allkepsek(){
        $data['kepseks'] =  DB::table('users')
        ->join('sekolah', function ($join) {
            $join->on('users.id_sekolah', '=', 'sekolah.id_sekolah')
                 ->where('users.role_akun', '=', 1);
        })
        ->get();
        return view('directory.kepsek',$data);
    }

    public function allbendahara(){
        $data['bendaharas'] =DB::table('users')
        ->join('sekolah', function ($join) {
            $join->on('users.id_sekolah', '=', 'sekolah.id_sekolah')
                 ->where('users.role_akun', '=', 2);
        })
        ->get();
    	return view('directory.bendahara',$data);
    }
}
