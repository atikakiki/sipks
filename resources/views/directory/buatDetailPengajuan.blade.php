@extends('base.template')
@section('moreCSS')
  <style type="text/css">
    
  </style>
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                        <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                        <tr>
                            <th>Nama Detail</th>
                            <th>Jumlah</th>
                            <th width="40%"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><select class="form-control" id="id_detail_post">
                                <option value="">Pilih Detail</option>
                                @foreach($details as $key=>$detail)
                                <option value="{{$detail->id_detail}}">{{$detail->nama_detail}}</option>
                                @endforeach
                                </select>
                            </td> 
                            <td>
                                <input type="number" id="jumlah_detail_post"></input>
                            </td>
                            <td>
                                <button type="button" onclick="coba();" name="add" id="add" class="btn btn-success">Tambah</button>
                            </td>
                            </tr>
                        </tbody>
                        
                        </table>
                        </div>
                    <div class="box-body">
                        <form >
                            <table class="table table-bordered" name="detail_form" id="detail_form">
                            <h3>
                            <thead>
                        <tr>
                            <th>Nama Detail</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Sub Total</th>
                            
                        </tr>
                        </thead>
                        <tbody class="detail">
                           
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                            @csrf
                                <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                            </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                </div>
     </div>
   </div>
  </section>
@endsection

@section('moreJS')
<script type="text/javascript">
// $.ajaxSetup({
//       headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

function coba(){
        var id_detail = document.getElementById("id_detail_post").value;
        var jumlah_detail = document.getElementById("jumlah_detail_post").value;
        // var nama = document.getElementById("id_detail_post").innerHTML.value;
        var b = "lolo";
        $.ajax({
            url:"{{ route('pengajuan.getDetail') }}",
            type:"get",
            contentType: "application/json",
            async : "false",
            dataType: "json",
            data: {id_detail: id_detail},
                  success:function(data) {
                    //   if(data && data.length > 0){
                    //     // for(key in data){
                    //     //  var tmp =data[key];
                    //     //  console.log(tmp.nama_detail);
                    //     // }
                    //     data=$.parseJSON( data ); //parse response string
                    //     b=data.harga_satuan;//value of b
                    //     // content1=data.harga_satuan;
                    //     console.log(b);
                    //   }
                    var subtotal = jumlah_detail * data;
                    html = '<tr>';
                    html += '<td name="id_detail[]">';
                    html += id_detail;
                    html += '</td><td name="jumlah_detail[]">';
                    html += jumlah_detail;
                    html += '</td><td name="harga_satuan_detail[]">';
                    html += data;
                    html += '</td><td name="sub_total[]">';
                    html += subtotal;
                    html += '</td><td><button type="button" name="remove" onclick="hapus(this);" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
                    $('tbody.detail').append(html);
                    $('#id_detail_post').val("");
                    $('#jumlah_detail_post').val("");

                      
                    
                    // data.forEach(function(item){
                    // console.log(JSON.stringify(response));
                    // var l = JSON.stringify(response);
                    // var t = replace("[{]}]", "", l);
                //   $('#jabatan_pembuat_pengajuan').val(response);
                    // alert(b);
                  // $.each(data.subcategories[0].subcategories,function(index,subcategory){
                  //   $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                  
              }
          });
        // var jumlah_detail = document.getElementById("jumlah_detail_post").value;
        // html = '<tr>';
        // html += '<td name="id_detail[]">';
        // html += id_detail;
        // html += '</td><td name="jumlah_detail[]">';
        // html += jumlah_detail;
        // html += '</td><td name="harga_satuan_detail[]">';
        // html += b;
        // html += '</td><td><input type="number" name="sub_total[]" class="form-control" /></td>';
        // html += '<td><button type="button" name="remove" onclick="hapus(this);" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
        // $('tbody.detail').append(html);
        // $('#id_detail_post').val("");
        // $('#jumlah_detail_post').val("");

 

        // alert(id);
    }

    function hapus(row){
        var d = row.parentNode.parentNode.rowIndex;
      document.getElementById('detail_form').deleteRow(d);
    }
$(document).ready(function(){
    
    // var count = 1;
    // detail_field(count);
    
    // function detail_field(number)
    // {
    //     html = '<tr>';
    //     html += '<td><select class="form-control" name="id_detail[]"><option value="">Pilih Detail</option>@foreach($details as $key=>$detail)<option value="{{$detail->id_detail}}">{{$detail->nama_detail}}</option>@endforeach</select></td>';
    //     html += '<td><input type="number" name="jumlah_detail[]" class="form-control" /></td>';
    //     html += '<td><input type="text" disabled name="harga_satuan_detail[]" class="form-control" /></td>';
    //     html += '<td><input type="number" name="sub_total[]" class="form-control" /></td>';
    //     if(number > 1)
    //     {
    //         html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
    //         $('tbody').append(html);
    //     }
    //     else
    //     {   
    //         html += '<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td></tr>';
    //         $('tbody').html(html);
    //     }
    // }

// $(document).on('click', '#add', function(){
//     $('#id_detail_post').on('change',function(e) {
// //  count++;
// //  detail_field(count);
// var id = e.target.value;
// alert(id);
//     });
// });

// $(document).on('click', '#remove', function(){

//  $(this).closest("tr").remove();
// });

$('#detail_form').on('submit', function(event){
    //    event.preventDefault();
       $.ajax({
           url:'{{ route("detail-field.insert") }}',
           method:'post',
           data:$(this).serialize(),
           dataType:'json',
           beforeSend:function(){
               $('#save').attr('disabled','disabled');
           },
           success: function(response) {
            window.location.replace('{{ url('/pengajuan') }}');
             }
        //    success:function(data)
        //    {
        //        if(data.error)
        //        {
        //            var error_html = '';
        //            for(var count = 0; count < data.error.length; count++)
        //            {
        //                error_html += '<p>'+data.error[count]+'</p>';
        //            }
        //            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
        //        }
        //        else
        //        {
        //            detail_field(1);
        //            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
        //        }
        //        $('#save').attr('disabled', false);
        //    }
       })
});

});
</script>
@endsection
