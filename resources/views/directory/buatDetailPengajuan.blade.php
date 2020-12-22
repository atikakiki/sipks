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
                            
                        <input type="hidden" name="id_pengajuan" id="id_pengajuan" value = "{{$id_pengajuan}}" ></input>
                            
                            <td><select class="form-control" id="id_detail_post" required>
                                <option value="">Pilih Detail</option>
                                @foreach($details as $key=>$detail)
                                <option value="{{$detail->id_detail}}">{{$detail->nama_detail}}</option>
                                @endforeach
                                </select>
                            </td> 
                            <td>
                                <input type="number" id="jumlah_detail_post" required></input>
                            </td>
                            <td>
                                <button type="button" onclick="coba();" name="add" id="add" class="btn btn-success">Tambah</button>
                            </td>
                            </tr>
                        </tbody>
                        
                        </table>
                        </div>
                    <div class="box-body">
                        
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
                                <input type="submit" onclick="postDetail();" name="save" id="save" class="btn btn-primary" value="Save" />
                            </td>
                            </tr>
                        </tfoot>
                    </table>
              
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
// var id = document.getElementById("id_pengajuan").value;
var arr_input=[];
// arr_input.push(id);

function coba(){
        var id_detail = document.getElementById("id_detail_post").value;
        var jumlah_detail = document.getElementById("jumlah_detail_post").value;
  
        $.ajax({
            url:"{{ route('pengajuan.getDetail') }}",
            type:"get",
            contentType: "application/json",
            async : "false",
            dataType: "json",
            data: {id_detail: id_detail},
                  success:function(data) {
                    var subtotal = jumlah_detail * data;
                    arr_input.push(id_detail,jumlah_detail,subtotal);
                    console.log(arr_input);
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
              }
          });

    }

    function hapus(row){
      var d = row.parentNode.parentNode.rowIndex;
      document.getElementById('detail_form').deleteRow(d);
      arr_input.splice(d-1,3)
    //   arrayRemove(arr_id_detail, d-1);
      console.log(arr_input);
        // console.log(d-1);
    }

    function postDetail(){
        // console.log('postDetail');
        var id = document.getElementById("id_pengajuan").value;
        // arr_input.push(id);
        // var arr_str = JSON.stringify(arr_input);
        // var input = join(id,arr_str);
        console.log(arr_input);
        $.ajax({
            url:'{{ route('pengajuan.postDetail') }}',
            type:'post',
            // contentType: 'application/json',
            async : 'false',
            // dataType: 'json',
            data: { id_pengajuan: id, arr: arr_input },
                  success:function(data) {
                    window.location ='{{ route('pengajuan') }}';
                    // console.log(data);
              }
          });
    }

</script>
@endsection
