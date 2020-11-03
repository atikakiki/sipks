@extends('base.template')
@section('moreCSS')
  <!-- <style type="text/css">
  	/* Make the image fully responsive */
  	  .content
  	  {
/*  	  	background-image: url("assets/boweFassetsr_components/bootstrap-daterangepicker/daterangepicker.js");*/

  	  	height: 100px;
  	  	background-size: cover;
  	  	background-position: center;
  	  	animation: ganti 7s infinite;
  	  }

  	  @keyframes ganti
  	  {
  	  	30%{
  	  		background-image: url("assets/dist/img/SIPKS1.jpeg");	
  	  	}
  	  	60%{
  	  		background-image: url("assets/dist/img/SIPKS2.png");
  	  	}
  	  	90%{
  	  		background-image: url("assets/dist/img/SIPKS1.jpeg");
  	  	}
  	  	60%{
  	  		background-image: url("assets/dist/img/SIPKS2.png");
  	  	}
  	  	90%{
  	  		background-image: url("assets/dist/img/SIPKS1.jpeg");	
  	  	}
  	  }
    
 
  </style> -->
@endsection

@section('content')
<section class="content">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
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
