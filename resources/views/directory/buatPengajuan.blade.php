@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1><strong>
    Buat Pengajuan </strong>
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	  <li>Data Pengajuan</li>
	  <li class="active">Buat Pengajuan</li>
  </ol>
</section>

<section class="content"> 
<div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  
        <div class="box-body">
        <form action="{{ url('pengajuan/postPengajuan') }}" method="POST">
        @csrf
                <div class="form-group">
                  <label>Sekolah</label>
                  <select class="form-control" name="id_sekolah">
                  <option value="" disabled selected>Pilih Sekolah</option>
                  @foreach($sekolahs as $key=>$sekolah)
                    <option value="{{$sekolah->id_sekolah}}">{{$sekolah->nama_sekolah}}</option>
                  @endforeach
                  </select>
                  <!-- <input type="text" class="form-control" name="id_sekolah" placeholder="Masukkan Nama Sekolah" required> -->
                </div>
                <div class="form-group">
                  <label>Judul Pengajuan</label>
                  <input type="text" class="form-control" name="judul_pengajuan" placeholder="Masukkan Judul Pengajuan" required>
                </div>
                <div class="form-group">
                  <label>Deskripsi Pengajuan</label>
                  <input type="text" class="form-control" name="deskripsi_pengajuan" placeholder="Masukkan Deskripsi Pengajuan" required>
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="text" class="form-control" name="jumlah_pengajuan" placeholder="Masukkan Nominal Pengajuan" required>
                </div>
                <div class="form-group">
                  <label>Nama Peminta</label>
                  <select class="form-control" name="nama_pembuat_pengajuan">
                  <option value="" disabled selected>Pilih Nama</option>
                  
                    <option value=""></option>
                  
                  </select>
                  <!-- <input type="text" class="form-control" name="nama_pembuat_pengajuan" placeholder="Masukkan Nama Pembuat Pengajuan" required> -->
                </div>
                <div class="form-group">
                  <label>Jabatan Peminta</label>
                  <select class="form-control" name="jabatan_pembuat_pengajuan">
                  <option value="" disabled selected>Pilih Jabatan</option>
                  
                    <option value=""></option>
                  
                  </select>
                  <!-- <input type="text" class="form-control" name="jabatan_pembuat_pengajuan" placeholder="Masukkan Jabatan Pembuat Pengajuan" required> -->
                  <!-- <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                  </select> -->
                </div>
                
              </div>
              <div class="box-footer">
                <button type="button" onclick="location.href='{{ url('/pengajuan')}}'" class="btn btn-default pull-left" >Close</button>
                <button type="submit" class="btn btn-primary pull-right">Selanjutnya</button>
              </div>
            </form>
	    </div>
	  </div>
	</div>
  </section>
@endsection

@section('moreJS')
  <script type="text/javascript">


  </script>
@endsection
