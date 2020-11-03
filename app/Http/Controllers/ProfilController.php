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
    	$data['user'] = User::where('id',Auth::user()->id)->first();
    	return view('directory.lookprofil',$data);
    }
}
