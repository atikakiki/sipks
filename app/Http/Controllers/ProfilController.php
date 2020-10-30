<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    	return view('directory.lookprofil');
    }
}
