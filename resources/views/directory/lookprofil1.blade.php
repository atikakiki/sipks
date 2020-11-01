@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    body{
        margin-top:20px;
 /*       background:#f8f8f8*/
    }
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    Profil
  </h1>
</section>


<section class="content">
<!-- <div class="container"> -->
	<div class="row">

      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="img-fluid img-circle" alt="avatar">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">

      	<div class="col-md-12">	
      		<div class="col-md-9">
	        <h4 style="margin-left: 100px">Personal info</h4>
	    	</div>
	        
	        <div class="col-md-3">
	        <a class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-add"> Edit Profil</a>
	        </div>
        </div>

        
        <form class="form-horizontal" role="form">

        
<!--           <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="button" class="btn btn-primary" value="Save Changes">
              <span></span>
            </div>
          </div> -->

          <div class="form-group">
            <label class="col-lg-3 control-label ">Id:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Jane">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">NIP:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Bishop">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Nama:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" value="janeuser">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="janesemail@gmail.com">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">No Telepon:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" value="janeuser">
            </div>
          </div>
        
        </form>
      </div>
  </div>
</section>


@endsection

@section('moreJS')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
