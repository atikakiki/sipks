@extends('base.template')
@section('moreCSS')
  <style type="text/css">
 
.emp-profile{
    padding: 2%;
    border-radius: 0.5rem;
    background: #ecf0f5;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}

.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}   
 
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    Personal Info
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-user"></i>Profil</a></li>
	<!--     <li><a href="#">Table Pengasuhan</a></li> -->
	  <li class="active">Personal Info</li>
  </ol>
</section>

<section class="content">

  <div class="container emp-profile">
    <link rel="icon" type="image/png" href="#">

    
    <form method="post">

        <div class="row">
            <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <!-- <img src="#" width="64" /> -->
                     <!--        <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div> -->
                        </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                        <h4>Data Diri</h4>
                                    
                  <!--           <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li> -->
                    <!--             <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
                                </li> -->
                         <!--    </ul> -->
                         <br><br><br>
                         @foreach($users as $key=>$user)
                         <div class="row">
                             <div class="col-md-6">
                                 <label>Sekolah</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->nama_sekolah}}</p>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <label>NIP</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->NIP_akun}}</p>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <label>Nama</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->name}}</p>
                             </div>
                         </div>
                        
                         <div class="row">
                             <div class="col-md-6">
                                 <label>Email</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->email}}</p> 
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <label>Alamat</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->alamat_akun}}</p>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <label>No Telepon</label>
                             </div>
                             <div class="col-md-6">
                                 <p>{{$user->no_telp_akun}}</p>
                             </div>
                         </div>
                </div>
            </div>
            @endforeach
        <!--     <div class="col-md-2"> -->
                        <!-- <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/> -->
                       <!--   <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#">Edit Profile</a> -->
                        <!-- <a style="background-color: #800000;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="">Edit Profile</a>  -->
   
         <!--    </div> -->

          <!-- tutup row -->
        </div>

       </form>  
 
</div>


</section>
@endsection

@section('moreJS')
  <script type="text/javascript">


  </script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
@endsection