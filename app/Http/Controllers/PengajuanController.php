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
use App\Models\Pengajuan;
use App\Models\DetailPengajuan;

class PengajuanController extends Controller
{
    //
    public function awal(){
        $data['pengajuans'] = Pengajuan::get();
    	return view('directory.pengajuan', $data);
    }


    public function buatPengajuan(){

    	return view('directory.buatPengajuan');
    }

    public function detailPengajuan($id){
         $data['detail_pengajuans'] = DetailPengajuan::where('id_pengajuan',$id)->get();
    	return view('directory.detailPengajuan', $data);
    }

    public function downloadCoursesTemplate()
    {
        return Excel::download(new CoursesTemplateExport(), 'Courses.xlsx');
    }

}
