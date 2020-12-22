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
          <button onclick="location.href='{{ url('/pengajuan/tambah')}}'" type="button" class = "btn btn-danger"><i class = "fa fa-plus"></i> Tambah Pengajuan</button>
        </div>
	        <table id="example2" class="table table-striped table-bordered bg-info table-hover text-center">
	          <thead>
	            <tr>
                <th>No</th>
                <!-- <th>ID</th> -->
                <th>Sekolah</th>
                <th>Waktu Pengajuan</th>
                <th>Judul</th>
                <!-- <th>Deskripsi</th> -->
                <th>Jumlah</th>
                <th>Nama Pembuat</th>
                <th>Nama Peminta</th>
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
	              <!-- <td>{{$pengajuan->id_pengajuan}}</td> -->
	              <td>{{$pengajuan->nama_sekolah}}</td>
                <td>{{$pengajuan->create_time_pengajuan}}</td>
	              <td>{{$pengajuan->judul_pengajuan}}</td>
	              <!-- <td>{{$pengajuan->deskripsi_pengajuan}}</td> -->
	              <td>{{$pengajuan->jumlah_pengajuan}}</td>
                <td>{{$pengajuan->name}}</td>
                <td>{{$pengajuan->nama_pembuat_pengajuan}}</td>
                  @if($pengajuan->status_pengajuan =='0')
                    <td><label class="label bg-red">Belum Disetujui</label></td>
                  @elseif($pengajuan->status_pengajuan =='1')
                    <td><label class="label bg-yellow">Disetujui Bendahara</label></td>
                  @elseif($pengajuan->status_pengajuan =='2')
                    <td><label class="label bg-green">Disetujui Kepala Sekolah</label></td>
                  @elseif($pengajuan->status_pengajuan =='3')
                    <td><label class="label bg-black">Ditolak</label></td>
                @endif
	              <!-- <td>{{$pengajuan->status_pengajuan}}</td> -->
	              <td><button class="btn btn-primary" onclick="location.href='{{ url('/pengajuan/detail/'.$pengajuan->id_pengajuan)}}'" type="button"><i class="fa fa-fw fa-info"></i></button>
				  		<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$pengajuan->id_pengajuan}}"><i class="fa fa-fw fa-pencil"></i></button>
              <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-hapus{{$pengajuan->id_pengajuan}}"><i class="fa fa-fw fa-trash"></i></button>
                  </td>
	            </tr>

              <div class="modal modal-danger fade" id="modal-hapus{{$pengajuan->id_pengajuan}}" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Hapus Pengajuan</h4>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin menghapus pengajuan ini? {{$pengajuan->id_pengajuan}}</p>
                    </div>
                    <div class="modal-footer">
                      <form action = "{{ url('pengajuan/hapus/'.$pengajuan->id_pengajuan) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline" >Ya</button>
                      </form>
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                    </div>
                   </div>
                  <!-- /.modal-content -->
                  </div>
                </div>
                <!-- /.modal-dialog -->
              
              <div class="modal fade" id="modal-edit{{$pengajuan->id_pengajuan}}" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Pengajuan</h4>
                  </div>
                  <div class="modal-body">
                  <form action="{{ url('pengajuan/edit/'.$pengajuan->id_pengajuan) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                      <label>Sekolah</label>
                      <input type="text" class="form-control" name="nama_sekolah" value="{{ $pengajuan->nama_sekolah }}" disabled>
                    </div>
                    <div class="form-group">
                      <label>Judul Pengajuan</label>
                      <input type="text" class="form-control" name="judul_pengajuan" value="{{$pengajuan->judul_pengajuan}}" required>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi Pengajuan</label>
                      <input type="text" class="form-control" name="deskripsi_pengajuan" value="{{$pengajuan->deskripsi_pengajuan}}" required>
                    </div>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="text" class="form-control" name="jumlah_pengajuan" value="{{$pengajuan->jumlah_pengajuan}}" disabled>
                    </div>
                    <div class="form-group">
                      <label>Nama Pembuat</label>
                      <input type="text" class="form-control" name="nama_pembuat_pengajuan" value="{{$pengajuan->nama_pembuat_pengajuan}}" disabled>
                    </div>
                    <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                  </form>
                </div>
                </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
              @endforeach
	          </tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	  
	</div>

  </section>
@endsection

@section('moreJS')
  <script type="text/javascript">
     function delete_confirm(url){
      $('#modal-hapus').modal();
      $('#btn-delete').attr("href", url);
    }
  </script>
@endsection
