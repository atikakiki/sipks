@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1><strong>
    Data Pengajuan </strong>
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<!--     <li><a href="#">Table Pengasuhan</a></li> -->
	  <li class="active">Data Pengajuan</li>
  </ol>
</section>

<section class="content">
<div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  
        <div class="box-body" style="overflow-y:scroll">
          <div class = "page-header">
          <button onclick="location.href='{{ url('/pengajuan/buat')}}'" type="button" class = "btn btn-danger"><i class = "fa fa-plus"></i> Tambah Pengajuan</button>
          <button onclick="location.href='{{ url('/pengajuan/download_template')}}'" type="button" class = "btn btn-success"><i class = "fa fa-download"></i> Download template detail</button>
        </div>
	        <table id="example2" class="table table-striped table-bordered bg-info table-hover text-center">
	          <thead>
	            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Sekolah</th>
                <th>Akun</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
	            </tr>
	          </thead>
	          <tbody>
	          <?php 
	            $no = 1;
	           ?> 


             @foreach($pengajuans as $key => $pengajuan)                                    
	            <tr>
	              <td>{{$key+1}}</td>
	              <td>{{$pengajuan->id_pengajuan}}</td>
	              <td>1</td>
	              <td>1</td>
	              <td>{{$pengajuan->judul_pengajuan}}</td>
	              <td>ATK periode 2019/2020</td>
	              <td>1.000.000</td>
	              <td>Menunggu Persetujuan</td>
	              <td><button class="btn btn-primary" onclick="location.href='{{ url('/pengajuan/detail/'.$pengajuan->id_pengajuan)}}'" type="button">Detail</button>
				  		<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit">Edit</button>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-hapus">Hapus</button>
                  </td>
	            </tr>
	           @endforeach
	          </tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	  <div class="modal fade in" id="modal-edit" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Pengajuan</h4>
              </div>
              <form action="" method="post">
              <div class="modal-body">
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
                  <label>Detail Pengajuan</label>
                  <input type="file" id="detail_pengajuan">
                </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
              
            </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal modal-danger fade" id="modal-hapus" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Hapus Pengajuan</h4>
              </div>
              <div class="modal-body">
                <p>Anda yakin ingin menghapus pengajuan ini?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-outline">Ya</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
	</div>
  </section>
@endsection

@section('moreJS')
  <script type="text/javascript">


  </script>
@endsection
