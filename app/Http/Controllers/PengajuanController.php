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
use App\Models\User;

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

    public function postPengajuan(Request $request){
 
              $newPengajuan = new Pengajuan();
              $newPengajuan->id_sekolah = $request->id_sekolah;
              $newPengajuan->id_akun = Auth::user()->id;
              $newPengajuan->judul_pengajuan = $request->judul_pengajuan;
              $newPengajuan->deskripsi_pengajuan = $request->deskripsi_pengajuan;
              $newPengajuan->jumlah_pengajuan = $request->jumlah_pengajuan;
              $newPengajuan->nama_pembuat_pengajuan = $request->nama_pembuat_pengajuan;
              $newPengajuan->jabatan_pembuat_pengajuan = $request->jabatan_pembuat_pengajuan;
              $newPengajuan->status_pengajuan = 1;
            //dd($request);
              // if($request->file('img') != NULL){
              //   $picture = $request->file('img');
              //   $newUser->picture = 'uploads/avatar/'.$newUser->username.'.'.$picture->getClientOriginalExtension();
              //   $picture->move('uploads/avatar/',$newUser->picture);
              // }
               
              $newPengajuan->save();
            return redirect('/pengajuan')->with('success','Pengajuan ditambahkan.');
  
    }

    public function hapusPengajuan($id){
        //return dd($id);
        Pengajuan::destroy($id);
        return redirect('/pengajuan');
    }

    public function editPengajuan(Request $request, $id){
        $updatePengajuan = Pengajuan::find($id);
        $updatePengajuan->id_sekolah = $request->id_sekolah;
        // $updatePengajuan->id_akun = Auth::user()->id;
        $updatePengajuan->judul_pengajuan = $request->judul_pengajuan;
        $updatePengajuan->deskripsi_pengajuan = $request->deskripsi_pengajuan;
        $updatePengajuan->jumlah_pengajuan = $request->jumlah_pengajuan;
        $updatePengajuan->nama_pembuat_pengajuan = $request->nama_pembuat_pengajuan;
        $updatePengajuan->jabatan_pembuat_pengajuan = $request->jabatan_pembuat_pengajuan;
        // $updatePengajuan->status_pengajuan = $request->status_pengajuan;
        // return dd($updatePengajuan);
        $updatePengajuan->save();
        return redirect('/pengajuan');
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
