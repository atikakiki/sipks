@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
        
          @if (count($errors) > 0)
            <div class = "callout callout-danger">
            <strong>Attention</strong>
            <ul>
              @foreach ($errors->all() as $error)
              <li> {{$error}}</li>
              @endforeach
            </ul>
            </div>
            @endif
        <form action="{{ url('pengajuan/postPengajuan') }}" method="POST">
        @csrf
                @foreach($sekolah as $key => $sekolah)
               <input type="hidden" class="form-control" name="id_sekolah" value="{{$sekolah->id_sekolah}}">

               <div class="form-group">
                 <label>Sekolah</label>
                 <input type="text" disabled class="form-control" name="nama_sekolah" value="{{$sekolah->nama_sekolah}}">
               </div>
                @endforeach
                <div class="form-group">
                  <label>Judul Pengajuan</label>
                  <input type="text" class="form-control" id="judul_pengajuan" name="judul_pengajuan" placeholder="Masukkan Judul Pengajuan" value = "{{old('judul_pengajuan')}}" required>
                </div>
                <div id ="result"></div>
                <div class="form-group">
                  <label>Deskripsi Pengajuan</label>
                  <input type="text" class="form-control" name="deskripsi_pengajuan" placeholder="Masukkan Deskripsi Pengajuan" value = "{{old('deskripsi_pengajuan')}}" required>
                </div>
                <div class="form-group">
                  <label>Nama Peminta</label>
                  <select class="form-control"  name="nama_pembuat_pengajuan" id="nama_pembuat_pengajuan" required>
                    <option value="" selected>Pilih Nama</option>
                    @foreach($users as $key=>$user)
                    <option value="{{$user->name}}">{{$user->name}}</option>
                    @endforeach
                  </select>
             </div>
                <div class="form-group">
                  <label>Jabatan Peminta</label>
                  <input type="text" disabled class="form-control" name="jabatan_pembuat_pengajuan" id="jabatan_pembuat_pengajuan">
                </div>
                </div>
                
              </div>
              <div class="box-footer">
                <button type="button" onclick="location.href='{{ url('/pengajuan')}}'" class="btn btn-default pull-left" >Close</button>
                <button type="submit" class="btn btn-primary pull-right">Selanjutnya</button>
              </div>
            </form>
	    </div>
	  </div>
	
  </section>
@endsection

@section('moreJS')

  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  $(document).ready(function () {
      $('#nama_pembuat_pengajuan').on('change',function(e) {
        var id_akun = e.target.value;
          $.ajax({
            url:"{{ route('pengajuan.getJabatan') }}",
            type:"get",
            // contentType: "application/json",
            // dataType: "json",
            data: {id: id_akun},
                  success:function(response) {
                  // console.log(Object.values(response));
                    // var resp = JSON.stringify(response);
                    // // var tes = preg_replace("/[^a-zA-Z0-9]/", "", resp)
                    // var res = resp.split(":");
                    // var r = res[1];
                    // var ok = preg_replace("/[^a-zA-Z]/", "", r);
                    // alert(response);
                  $('#jabatan_pembuat_pengajuan').val(response);
                  // alert(JSON.stringify(response));
                  // $.each(data.subcategories[0].subcategories,function(index,subcategory){
                  //   $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                  // })
              }
          })
      });
  });
  </script>
@endsection
