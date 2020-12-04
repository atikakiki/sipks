@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  .conta {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.conta input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  width: 30px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.conta:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.conta input:checked ~ .checkmark {
  background-color: #2196F3;
}

.conta input:disabled ~ .checkmark {
  background-color: #20E254
}


/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.conta input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.conta .checkmark:after {
  left: 13px;
  top: 10px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

 .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
     background-color: #f4f4f4;
  }
</style>
@endsection


@section('content')
<section class="content-header">
  <h1>
    Data Kepala Sekolah
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<!--     <li><a href="#">Table Pengasuhan</a></li> -->
	  <li class="active">Kepala Sekolah</li>
  </ol>
</section>

<section class="content">
	<div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  

	      <div class="box-body" style="overflow-y:scroll">
	        <table id="example2" class="table table-striped table-bordered bg-info table-hover text-center">
	          <thead>
	            <tr>
	             <th>No</th>
	             <th>Sekolah</th>
	             <th>NIP</th>
      				 <th>Nama</th>
      				 <th>Email</th>
      				 <th>Alamat</th>
      				 <th>Nomor Telepon</th>
	            </tr>
	          </thead>
	          <tbody>

             @foreach($kepseks as $key=>$kepsek)

	            <tr>
	              <td>{{$key+1}}</td>
	              <td>{{$kepsek->nama_sekolah}}</td>
	              <td>{{$kepsek->NIP_akun}}</td>
	              <td>{{$kepsek->name}}</td>
	              <td>{{$kepsek->email}}</td>
	              <td>{{$kepsek->alamat_akun}}</td>
	              <td>{{$kepsek->no_telp_akun}}</td>
	            </tr>

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


  </script>
@endsection