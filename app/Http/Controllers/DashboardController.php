<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
