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
	  <li><a href="{{ url('/pengajuan')}}">Data Pengajuan</a></li>
	  <li class="active">Judul Pengajuan</li>
  </ol>
</section>

<section class="content"> 

    <div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  
        <div class="box-body" style="overflow-y:scroll">
          <div class = "page-header">
          @foreach ($judul as $key => $j)
            <h3> {{$j->judul_pengajuan}} </h3>
            <h5> Deskripsi : <br> {{$j->deskripsi_pengajuan}}</h5>
            @if($j->status_pengajuan =='0')
            <button onclick="location.href='{{ route('tambahDetail',[$j->id_pengajuan])}}'" type="button" class = "btn btn-danger"><i class = "fa fa-plus"></i> Tambah Detail Pengajuan</button>
              @endif
          </div>
       
	        <table id="example2" class="table table-striped table-bordered bg-info table-hover text-center">
	          <thead>
	            <tr>
                <th>No</th>
                <!-- <th>ID Detail</th> -->
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
             @foreach ($detail_pengajuans as $key => $dp)                                 
	            <tr>
	              <td>{{$key+1}}</td>
	              <!-- <td>{{$dp->id_detail}}</td> -->
	              <td>{{$dp->nama_detail}}</td>
	              <td>{{$dp->jumlah_detail}}</td>
	              <td>{{$dp->harga_satuan}}</td>
	              <td>{{$dp->sub_total}}</td>
                @if($j->status_pengajuan =='0')
                <td>
              <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$dp->id_mapping_pengajuan_detail}}"><i class="fa fa-fw fa-pencil"></i></button>
              <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-hapus{{$dp->id_mapping_pengajuan_detail}}"><i class="fa fa-fw fa-trash"></i></button>
                  </td>
                  @endif
	            </tr>

              <div class="modal modal-danger fade" id="modal-hapus{{$dp->id_mapping_pengajuan_detail}}" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Hapus Detail</h4>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin menghapus detail pengajuan {{$dp->id_mapping_pengajuan_detail}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <form action = "{{ url('detailpengajuan/hapus/'.$dp->id_pengajuan.'/'.$dp->id_mapping_pengajuan_detail) }}" method="post">
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

                <div class="modal fade" id="modal-edit{{$dp->id_mapping_pengajuan_detail}}" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Detail Pengajuan</h4>
                  </div>
                  <div class="modal-body">
                  <form action="{{ url('detailpengajuan/edit/'.$dp->id_pengajuan.'/'.$dp->id_mapping_pengajuan_detail) }}" method="POST">
                    @csrf
                    @method('put')
                  <!--   <div class="form-group"> -->
                     <!--  <label>ID Detail</label>
 -->                      <input type="text" class="form-control" name="id_mapping_pengajuan_detail" value="{{ $dp->id_mapping_pengajuan_detail}}" required>
                   <!--  </div> -->
                    <div class="form-group">
                      <label>Nama Detail</label>
                      <!-- <input type="text" class="form-control" name="id_detail" value="{{$dp->id_detail}}" required>{{$dp->nama_detail}} -->
                      <select class="form-control" name="id_detail">
                        <option value="{{$dp->id_detail}}" selected>{{$dp->nama_detail}}</option>
                        @foreach($details as $key=>$detail)
                        <option value="{{$detail->id_detail}}">{{$detail->nama_detail}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" class="form-control" name="jumlah_detail" value="{{$dp->jumlah_detail}}" required>
                    </div>
                    <div class="form-group">
                      <label>Harga Satuan</label>
                      <input type="text" class="form-control" name="harga_satuan_detail" value="{{$dp->harga_satuan}}" required disabled>
                    </div>
                    <div class="form-group">
                      <label>Total</label>
                      <input type="text" class="form-control" name="sub_total" value="{{$dp->sub_total}}" required>
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
            <tfoot>
            <tr>
                <th colspan="4">Nominal Pengajuan</th>
                <th>{{$j->jumlah_pengajuan}}</th>
	            </tr>
            </tfoot>
            @endforeach
          </table>
	      </div>

	    </div>
	  </div>
	</div>

  </section>
@endsection



@section('moreJS')
  <script type="text/javascript">


  </script>
@endsection
