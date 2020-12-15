<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
use App\Models\User;
use App\Models\Pengajuan;

//ytambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;


class DashboardController extends Controller
{
    public function index(){
        $data['pengajuan_disetujui'] = DB::table('Pengajuan')
                                        ->join('Users', 'Users.id','=','pengajuan.id_akun')
                                        ->where('Pengajuan.id_sekolah','=', Auth::user()->id_sekolah)
                                        ->where('Pengajuan.status_pengajuan','2')
                                        ->get();
        $data['pengajuan_ditolak'] = DB::table('Pengajuan')
                                        ->join('Users', 'Users.id','=','pengajuan.id_akun')
                                        ->where('Pengajuan.id_sekolah','=', Auth::user()->id_sekolah)
                                        ->where('Pengajuan.status_pengajuan','3')
                                        ->get();
        $data['count'] = Sekolah::get()->count();
        $data['belum_disetujui'] = Pengajuan::whereIn('status_pengajuan', [0,1])->get()->count();
        $data['ditolak'] = Pengajuan::where('status_pengajuan', '3')->get()->count();
        $data['selesai_disetujui'] = Pengajuan::where('status_pengajuan', '2')->get()->count();
    	return view('directory.dashboard',$data);
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
