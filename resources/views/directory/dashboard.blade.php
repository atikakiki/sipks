@extends('base.template')
@section('moreCSS')
  
@endsection

@section('content')
<section class="content">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
        @foreach($profil as $p)
        <h4>Selamat Datang, {{$p->name}} !</h4>
        <p>{{$p->nama_sekolah}}</p>
        @endforeach
        </div>
      </div>
  </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Pengajuan</span>
              <span class="info-box-number">{{$count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-refresh"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Menunggu Persetujuan</span>
              <span class="info-box-number">{{$belum_disetujui}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-minus-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengajuan Ditolak</span>
              <span class="info-box-number">{{$ditolak}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Selesai Disetujui</span>
              <span class="info-box-number">{{$selesai_disetujui}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class = "box box-solid box-success">
      <div class="box-header with-border">
              <h3 class="box-title">Pengajuan Selesai</h3>
            </div>
      <div class="box-body">
      <table id="example2" class="table table-bordered">
	          <thead>
	            <tr>
                <th>No</th>
                <th>Waktu Pengajuan</th>
                <th>Judul</th>
                <th>Jumlah</th>
                <th>Pembuat</th>
                <th>Peminta</th>
	            </tr>
	          </thead>
	          <tbody>
	          <?php 
	            $no = 1;
	           ?> 
             @foreach($pengajuan_disetujui as $key => $pengajuan) 
             <tr>
            <td>{{$key+1}}</td>
                <td>{{$pengajuan->create_time_pengajuan}}</td>
	              <td>{{$pengajuan->judul_pengajuan}}</td>
	              <td>{{$pengajuan->jumlah_pengajuan}}</td>
                <td>{{$pengajuan->name}}</td>
                <td>{{$pengajuan->nama_pembuat_pengajuan}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
      </div>
      </div>

      <div class = "box box-solid box-danger">
      <div class="box-header with-border">
              <h3 class="box-title">Pengajuan Ditolak</h3>
            </div>
      <div class="box-body">
      <table id="example1" class="table table-bordered">
	          <thead>
            <tr>
                <th>No</th>
                <th>Waktu Pengajuan</th>
                <th>Judul</th>
                <th>Jumlah</th>
                <th>Pembuat</th>
                <th>Peminta</th>
	            </tr>
	          </thead>
	          <tbody>
	          <?php 
	            $no = 1;
	           ?> 
            @foreach($pengajuan_ditolak as $key => $pengajuan) 
             <tr>
            <td>{{$key+1}}</td>
                <td>{{$pengajuan->create_time_pengajuan}}</td>
	              <td>{{$pengajuan->judul_pengajuan}}</td>
	              <td>{{$pengajuan->jumlah_pengajuan}}</td>
                <td>{{$pengajuan->name}}</td>
                <td>{{$pengajuan->nama_pembuat_pengajuan}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
      </div>
      </div>
 </section>

@endsection

@section('moreJS')
<script>
//   $(function() {
//     $('.content').hide();

//     $('.content').fadeIn(500);
//   });

</script>
@endsection
