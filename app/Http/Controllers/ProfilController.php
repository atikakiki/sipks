<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//tambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;

class ProfilController extends Controller
{
    //
    public function lihatprofil()
    {
    	$data['users'] = DB::table('users')
        ->join('sekolah', function ($join) {
            $join->on('users.id_sekolah', '=', 'sekolah.id_sekolah')
                 ->where('users.id',Auth::user()->id);
        })
        ->get();
    	return view('directory.lookprofil',$data);
    }
}
