@extends('base.template')
@section('moreCSS')
  <style type="text/css">
  	/* Make the image fully responsive */
  	  .content
  	  {
/*  	  	background-image: url("assets/boweFassetsr_components/bootstrap-daterangepicker/daterangepicker.js");*/

  	  	height: 720px;
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
    
 
  </style>
@endsection

@section('content')
<section class="content">
      
 </section>

@endsection

@section('moreJS')
<script>
  $(function() {
    $('.content').hide();

    $('.content').fadeIn(500);
  });

</script>
@endsection
