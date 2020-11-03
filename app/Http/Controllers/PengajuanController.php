<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//ytambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;

use App\Exports\CoursesTemplateExport;

class PengajuanController extends Controller
{
    //
    public function awal(){
    	return view('directory.pengajuan');
    }

    public function buatPengajuan(){
    	return view('directory.buatPengajuan');
    }

    public function detailPengajuan(){
    	return view('directory.detailPengajuan');
    }

    public function downloadCoursesTemplate()
    {
        return Excel::download(new CoursesTemplateExport(), 'Courses.xlsx');
    }

}
