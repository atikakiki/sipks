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
use App\Models\Jabatan;
use App\Models\MappingDetailPengajuan;

class PengajuanController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function awal(){
        // $data['pengajuans'] = Pengajuan::get();
        $data['pengajuans'] = DB::table('Pengajuan')
                                        ->join('Sekolah', 'sekolah.id_sekolah', '=', 'pengajuan.id_sekolah')
                                        ->join('Users', 'Users.id','=','pengajuan.id_akun')
                                        // ->where('users.id','=','pengajuan.id_akun')
                                        ->where('Pengajuan.id_sekolah','=', Auth::user()->id_sekolah)
                                        ->get();
    	return view('directory.pengajuan', $data);
    }


    public function buatPengajuan(){
        $data['sekolahs'] = DB::table('users')->join('Sekolah', function ($join)
        {
            $join->on('users.id_sekolah', '=', 'Sekolah.id_sekolah');
        })->where('users.id',Auth::user()->id)->select('sekolah.id_sekolah','sekolah.nama_sekolah')->get();
        $data['users'] = DB::table('users')->where('id_sekolah',Auth::user()->id_sekolah)->select('id','name','id_jabatan')->get();
        // dd($data);
    	return view('directory.buatPengajuan',$data);
    }

    public function postPengajuan(Request $request){
            $this->validate($request,[
                'judul_pengajuan' => 'unique:pengajuan'
             ]);
 
              $newPengajuan = new Pengajuan();
              $newPengajuan->id_sekolah = $request->id_sekolah;
              $newPengajuan->id_akun = Auth::user()->id;
              $newPengajuan->judul_pengajuan = $request->judul_pengajuan;
              $newPengajuan->deskripsi_pengajuan = $request->deskripsi_pengajuan;
              $newPengajuan->jumlah_pengajuan = 0  ;
              $newPengajuan->nama_pembuat_pengajuan = $request->nama_pembuat_pengajuan;
              $newPengajuan->status_pengajuan = 0;
              // if($request->file('img') != NULL){
              //   $picture = $request->file('img');
              //   $newUser->picture = 'uploads/avatar/'.$newUser->username.'.'.$picture->getClientOriginalExtension();
              //   $picture->move('uploads/avatar/',$newUser->picture);
              // }
               
             $status = $newPengajuan->save();
             if($status){
                 return redirect()->route('tambahDetail',[$newPengajuan->id_pengajuan]);
             }
             else{
                 return redirect('/pengajuan/tambah')->with('error','Judul Pengajuan sudah dipakai');
             }
    }

    public function getJabatan(Request $request){
        $data = Jabatan::join('users', 'jabatan.id_jabatan', '=', 'users.id_jabatan')
                    ->where('users.id',$request->id)
                    ->get('jabatan.nama_jabatan');
        $resp= explode(":",$data);
        $re=$resp[1];
        $res=substr($re, 1, -3);
        // $res= preg_replace("/[^a-zA-Z]/", "", $re);
                    // var r = res[1];
                    // var ok = preg_replace("/[^a-zA-Z]/", "", r);
        return response()->json($res);
        // dd($jabatan);
    }

    public function getDetail(Request $request){
        $data = DetailPengajuan::where('id_detail',$request->id_detail)
                    // ->select('id_detail','nama_detail','harga_satuan')
                    ->get('harga_satuan');
        $resp= explode(":",$data);
        $re=$resp[1];
        $res=substr($re, 0, -2);
        // $res= preg_replace("/[^a-zA-Z]/", "", $re);
                    // var r = res[1];
                    // var ok = preg_replace("/[^a-zA-Z]/", "", r);
                    $jsonResponse=json_encode($res);
                    return $jsonResponse;
        // dd($jabatan);
    }

        public function postDetail(Request $request){
            $id = $request->id_pengajuan;
            $arr = $request->arr;
            $val = [];
            $sql = [];
            $jumlah = 0;
             $arr_split = array_chunk($arr,3);
            // dd(count($arr_split));
            for($i=0;$i<count($arr_split);$i++){
                array_unshift($arr_split[$i], $id);
                // dd($arr_split[$i]);
                $detail = new MappingDetailPengajuan();
                $detail->id_pengajuan = $arr_split[$i][0];
                $detail->id_detail = $arr_split[$i][1];
                $detail->jumlah_detail = $arr_split[$i][2];
                $detail->sub_total = $arr_split[$i][3];
                
                $detail->save();
                $jumlah+=$detail->sub_total;
                // $i++;
                // $val[$i] ="(".implode(",",$arr_split[$i]).")";
                // $sql[$i] = "'".$str.$val[$i].";"."'";
            }
            
            // dd($jumlah);
            $pengajuan = Pengajuan::find($id);

            // Make sure you've got the Page model
            if($pengajuan) {
                // $jml = $pengajuan->jumlah;
                $pengajuan->jumlah_pengajuan += $jumlah;
                $pengajuan->save();
            }
            return response()->json('berhasil tambah detail');
        }

    public function tambahDetailPengajuan($id){
        $data['details'] = DetailPengajuan::get();
        $data['id_pengajuan'] = $id;
        // dd($data);
    	return view('directory.buatDetailPengajuan',$data);
    }


    public function hapusPengajuan($id){
        //return dd($id);
        MappingDetailPengajuan::where('id_pengajuan',$id)->delete();
        Pengajuan::destroy($id);
        return redirect('/pengajuan');
    }

    public function editPengajuan(Request $request, $id){
        $updatePengajuan = Pengajuan::find($id);
        // $updatePengajuan->id_sekolah = $request->id_sekolah;
        // $updatePengajuan->id_akun = Auth::user()->id;
        $updatePengajuan->judul_pengajuan = $request->judul_pengajuan;
        $updatePengajuan->deskripsi_pengajuan = $request->deskripsi_pengajuan;
        // $updatePengajuan->jumlah_pengajuan = $request->jumlah_pengajuan;
        // $updatePengajuan->nama_pembuat_pengajuan = $request->nama_pembuat_pengajuan;
        // $updatePengajuan->status_pengajuan = $request->status_pengajuan;
        // return dd($updatePengajuan);
        $updatePengajuan->save();
        return redirect('/pengajuan');
    }

    public function detailPengajuan($id){
        $data['details'] = DetailPengajuan::get();
        $data['judul']= Pengajuan::where('id_pengajuan',$id)->get();
        // $resp= explode(":",$judul);
        // $re=$resp[1];
        // $data['judul_pengajuan']=substr($re, 1, -3);
        $data['detail_pengajuans'] = DB::table('Pengajuan')
                                    ->join('mapping_pengajuan_detail','pengajuan.id_pengajuan','=', 'mapping_pengajuan_detail.id_pengajuan')
                                    ->join('detail_pengajuan', 'detail_pengajuan.id_detail', '=', 'mapping_pengajuan_detail.id_detail')
                                    ->where('mapping_pengajuan_detail.id_pengajuan',$id)
                                    ->get();
        //  dd($data);
         return view('directory.detailPengajuan', $data);
    }

    public function hapusdetailPengajuan($id_pengajuan,$id_mapping_pengajuan_detail){
        //return dd($id);
        $mapping_detail = MappingDetailPengajuan::find($id_mapping_pengajuan_detail);
        $sub_total = $mapping_detail->sub_total;
        $pengajuan = Pengajuan::find($id_pengajuan);

            // Make sure you've got the Page model
            if($pengajuan) {
                // $jml = $pengajuan->jumlah;
                $pengajuan->jumlah_pengajuan -= $sub_total;
                $pengajuan->save();
            }
        $mapping_detail->destroy($id_mapping_pengajuan_detail);
        return redirect()->route('detailawal', [$id_pengajuan]);
        // redirect()->action('App\Http\Controllers\PengajuanController@detailPengajuan', [1]);
    }

    public function editdetailPengajuan(Request $request,$id_mapping_pengajuan_detail){
        $updateDetail = MappingDetailPengajuan::find($id_mapping_pengajuan_detail);
        $updateDetail->id_detail = $request->id_detail;
        $updateDetail->jumlah_detail = $request->jumlah_detail;
        // $updateDetail->harga_satuan_detail = $request->harga_satuan_detail;
        $updateDetail->sub_total = $request->sub_total;

        $updateDetail->save();
        return redirect()->route('detailawal', [$id_pengajuan]);
    }

}
