@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1><strong>
    Detail Pengajuan </strong>
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	  <li>Data Pengajuan</li>
	  <li class="active">Judul Pengajuan</li>
  </ol>
</section>

<section class="content"> 

    <div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  
        <div class="box-body" style="overflow-y:scroll">
          <div class = "page-header">
            <h3> Judul pengajuan </h3>
       </div>
	        <table id="example2" class="table table-striped table-bordered bg-info table-hover text-center">
	          <thead>
	            <tr>
                <th>No</th>
                <th>ID Detail</th>
                <th>Nama Detail</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
                <th>Aksi</th>
	            </tr>
	          </thead>
	          <tbody>
	          <?php 
	            $no = 1;
	           ?>                                  
	            <tr>
	              <td><?php echo $no++; ?></td>
	              <td>123</td>
	              <td>Spidol /kotak</td>
	              <td>3</td>
	              <td>100.000</td>
	              <td>300.000</td>
	              <td><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit">Edit</button>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-hapus">Hapus</button>
                  </td>
	            </tr>
	          </tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	</div>

    <div class="modal fade in" id="modal-edit" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Detail Pengajuan</h4>
              </div>
              <form action="" method="post">
              <div class="modal-body">
                    <div class="form-group">
                    <label>ID Detail (nanti di hide/disabled)</label>
                    <input type="text" disabled class="form-control" id="id_akun">
                    </div>
                    <div class="form-group">
                    <label>Nama Detail</label>
                    <input type="text" class="form-control" id="nama_detail" placeholder="Pulpen /kotak">
                    </div>
                    <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" id="jumlah_detail" placeholder="3">
                    </div>
                    <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="text" class="form-control" id="harga_satuan_detail" placeholder="100.000">
                    </div>
                    <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control" id="total_harga_detail" placeholder="300.000">
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
                <h4 class="modal-title">Hapus Detail</h4>
              </div>
              <div class="modal-body">
                <p>Anda yakin ingin menghapus detail ini?</p>
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
