<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//ytambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;
use Validator;

use App\Models\Pengajuan;
use App\Models\Sekolah;
use App\Models\DetailPengajuan;
use App\Models\User;

class PengajuanController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function awal(){
        // $data['pengajuans'] = Pengajuan::get();
        $data['pengajuans'] = DB::table('Pengajuan')->join('Sekolah', function ($join)
        {
            $join->on('Pengajuan.id_sekolah', '=', 'Sekolah.id_sekolah');
        })->get();
    	return view('directory.pengajuan', $data);
    }


    public function buatPengajuan(){
        $data['sekolahs'] = Sekolah::get();
    	return view('directory.buatPengajuan',$data);
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
            //   $data['id_pengajuan']=$newPengajuan->id_pengajuan;
            //   dd($newPengajuan->id_pengajuan);
            return redirect()->route('tambahDetail',[$newPengajuan->id_pengajuan]);
            // return redirect('/pengajuan/tambahDetail', $data);
  
    }

//     public function postDetail(Request $request){
 
//         $id_pengajuan = Pengajuan::latest('id_pengajuan')->first()->id_pengajuan;
//         $newDetail = new DetailPengajuan();
//         $newDetail->id_pengajuan = $id_pengajuan;
//         $newDetail->nama_detail = $request->nama_detail;
//         $newDetail->jumlah_detail = $request->jumlah_detail;
//         $newDetail->harga_satuan_detail = $request->harga_satuan_detail;
//         $newDetail->total_harga_detail = $request->total_harga_detail;
//         // dd($newDetail);
//         // if($request->file('img') != NULL){
//         //   $picture = $request->file('img');
//         //   $newUser->picture = 'uploads/avatar/'.$newUser->username.'.'.$picture->getClientOriginalExtension();
//         //   $picture->move('uploads/avatar/',$newUser->picture);
//         // }
         
//         $newDetail->save();
//       //   $data['id_pengajuan']=$newPengajuan->id_pengajuan;
//       //   dd($newPengajuan->id_pengajuan);
//       return redirect('/pengajuan');
//             // return redirect('/pengajuan/tambahDetail', $data);
// }

        public function postDetail(Request $request)
            {
                $id_pengajuan = Pengajuan::latest('id_pengajuan')->first()->id_pengajuan;

                if($request->ajax())
                {
                $rules = array(
                'nama_detail.*'  => 'required',
                'jumlah_detail.*'  => 'required',
                'harga_satuan_detail.*'  => 'required',
                'total_harga_detail.*'  => 'required'
                );
                $error = Validator::make($request->all(), $rules);
                if($error->fails())
                {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
                }
                $nama_detail = $request->nama_detail;
                $jumlah_detail = $request->jumlah_detail;
                $harga_satuan_detail = $request->harga_satuan_detail;
                $total_harga_detail = $request->total_harga_detail;
                for($count = 0; $count < count($nama_detail); $count++)
                {
                $data = array(
                    'id_pengajuan'=>$id_pengajuan,
                    'nama_detail' => $nama_detail[$count],
                    'jumlah_detail'  => $jumlah_detail[$count],
                    'harga_satuan_detail' => $harga_satuan_detail[$count],
                    'total_harga_detail' => $total_harga_detail[$count]
                );
                $insert_data[] = $data; 
                }

                DetailPengajuan::insert($insert_data);
                // return redirect('/pengajuan');
                return response()->json([
                'success'  => 'Data Added successfully.'
                ]);
                }
            }

    public function tambahDetailPengajuan(){

    	return view('directory.buatDetailPengajuan');
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

    public function hapusdetailPengajuan($id_pengajuan,$id_detail){
        //return dd($id);
        DetailPengajuan::destroy($id_detail);
        return redirect()->route('detailawal', [$id_pengajuan]);
        // redirect()->action('App\Http\Controllers\PengajuanController@detailPengajuan', [1]);
    }

    public function editdetailPengajuan(Request $request,$id_pengajuan,$id_detail){
        $updateDetail = DetailPengajuan::find($id_detail);
        $updateDetail->nama_detail = $request->nama_detail;
        $updateDetail->jumlah_detail = $request->jumlah_detail;
        $updateDetail->harga_satuan_detail = $request->harga_satuan_detail;
        $updateDetail->total_harga_detail = $request->total_harga_detail;

        $updateDetail->save();
        return redirect()->route('detailawal', [$id_pengajuan]);
    }

}
