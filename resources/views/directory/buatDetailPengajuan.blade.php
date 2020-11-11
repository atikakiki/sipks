@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<section class="content-header">
  <h1><strong>
    Tambah Detail Pengajuan </strong>
  </h1>
  <ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	  <li>Data Pengajuan</li>
	  <li>Buat Pengajuan</li>
      <li class="active">Tambah Detail Pengajuan</li>
  </ol>
</section>

<section class="content"> 
<div class="row">
	  <div class="col-xs-12">
	    <div class="panel panel-warning">  
        <div class="box-body">
        <form action="{{ url('pengajuan/postDetail')}}" method="POST">
        @csrf
                <div class = "field_wrapper">
                <!-- <input type="text" class="form-control" name="nama_detail[]" value="'.$pengajuan->id_pengajuan'"> -->
                <!-- <button type="button" onclick="return add()" class="btn btn-primary" id="add_button" >Tambah</button> -->
                <div class="form-group">
                  <label>Nama Detail</label>
                  <input type="text" class="form-control" name="nama_detail" placeholder="Masukkan Nama Detail" required>
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="text" class="form-control" name="jumlah_detail" placeholder="Masukkan Jumlah" required>
                </div>
                <div class="form-group">
                  <label>Harga Satuan</label>
                  <input type="text" class="form-control" name="harga_satuan_detail" placeholder="Masukkan Harga Satuan" required>
                </div>
                <div class="form-group">
                  <label>Total</label>
                  <input type="text" class="form-control" name="total_harga_detail" placeholder="Masukkan Total Harga" required>
                </div>
              </div> 
              
                </div>
                <div class="box-footer">
                <button type="button" onclick="location.href='{{ url('/pengajuan')}}'" class="btn btn-default pull-left" >Close</button>
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>
            </form>
	    </div>
	  </div>
	</div>
  </section>
@endsection

@section('moreJS')
  <script type="text/javascript">
    // function add(){
    //     // var maxField = 10; //Input fields increment limitation
    //     //var addButton = $('#add_button'); //Add button selector
    //     var wrapper = $('.field_wrapper'); //Input field wrapper
    //     var fieldHTML = '<div class="form-group"><label>Nama Detail</label><input type="text" class="form-control" name="nama_detail[]" placeholder="Masukkan Nama Detail" required></div>';
    //     fieldHTML=fieldHTML + '<div class="form-group"><label>Jumlah</label><input type="text" class="form-control" name="jumlah_detail[]" placeholder="Masukkan Jumlah" required></div>';
    //     fieldHTML=fieldHTML + '<div class="form-group"><label>Harga Satuan</label><input type="text" class="form-control" name="harga_satuan_detail[]" placeholder="Masukkan Harga Satuan" required></div>'; 
    //     fieldHTML=fieldHTML + '<div class="form-group"> <label>Total</label><input type="text" class="form-control" name="total_harga_detail[]" placeholder="Masukkan Total Harga" required></div>'; 
    //     fieldHTML=fieldHTML + '<button type="button" class="btn btn-danger" >Hapus</button>'; 
    //     var x = 1; //Initial field counter is 1
     
    // // //Once add button is clicked
    // //     $(addButton).click(function(){
    // //         //Check maximum number of input fields
    //         // if(x < maxField){ 
    //         //     x++; //Increment field counter
    //             $(wrapper).append(fieldHTML); //Add field html
    //         // }
    //     }
     
    //Once remove button is clicked
//         $(wrapper).on('click', '.remove_button', function(e){
//             e.preventDefault();
//             $(this).parent('').parent('').remove(); //Remove field html
//             x--; //Decrement field counter
//         });
// }

  </script>
@endsection
