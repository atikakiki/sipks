<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//ytambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;

class PengajuanController extends Controller
{
    //
    public function awal(){
    	return view('directory.pengajuan');
    }

}
