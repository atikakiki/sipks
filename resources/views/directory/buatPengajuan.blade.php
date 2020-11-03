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
        <form action="" method="post">
                <div class="form-group">
                  <label>Sekolah</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>ID Akun (nanti di hide)</label>
                  <input type="text" class="form-control" id="id_akun" placeholder="Masukkan Judul Pengajuan">
                </div>
                <div class="form-group">
                  <label>Judul Pengajuan</label>
                  <input type="text" class="form-control" id="judul_pengajuan" placeholder="Masukkan Judul Pengajuan">
                </div>
                <div class="form-group">
                  <label>Deskripsi Pengajuan</label>
                  <input type="text" class="form-control" id="deskripsi_pengajuan" placeholder="Masukkan Deskripsi Pengajuan">
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="text" class="form-control" id="jumlah_pengajuan" placeholder="Masukkan Nominal Pengajuan">
                </div>
                <div class="form-group">
                  <label>Nama Pembuat</label>
                  <input type="text" class="form-control" id="nama_pembuat_pengajuan" placeholder="Masukkan Nama Pembuat Pengajuan">
                </div>
                <div class="form-group">
                  <label>Jabatan Pembuat</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Upload Detail Pengajuan</label>
                  <input type="file" id="detail_pengajuan">
                </div>
              </div>
              <div class="box-footer">
                <button type="button" onclick="location.href='{{ url('/pengajuan')}}'" class="btn btn-default pull-left" >Close</button>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
