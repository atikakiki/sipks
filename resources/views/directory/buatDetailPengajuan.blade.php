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
                <div class="table-responsive">
                    <form method="post" id="detail_form">
                    <span id="result"></span>
                        <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                        <tr>
                            <th width="35%">Nama Detail</th>
                            <th width="10%">Jumlah</th>
                            <th width="25%">Harga Satuan</th>
                            <th width="30%">Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="4" align="right">&nbsp;</td>
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
     </div>
   </div>
  </section>
@endsection

@section('moreJS')
<script type="text/javascript">
$(document).ready(function(){
    var count = 1;
    detail_field(count);

    function detail_field(number)
    {
        html = '<tr>';
        html += '<td><select class="form-control" name="id_detail[]"><option value="">Pilih Detail</option>@foreach($details as $key=>$detail)<option value="{{$detail->id_detail}}">{{$detail->nama_detail}}</option>@endforeach</select></td>';
        html += '<td><input type="number" name="jumlah_detail[]" class="form-control" /></td>';
        html += '<td><input type="text" name="harga_satuan_detail[]" class="form-control" /></td>';
        html += '<td><input type="number" name="sub_total[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td></tr>';
            $('tbody').html(html);
        }
    }

$(document).on('click', '#add', function(){
 count++;
 detail_field(count);
});

$(document).on('click', '.remove', function(){
 count--;
 $(this).closest("tr").remove();
});

$('#detail_form').on('submit', function(event){
       event.preventDefault();
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
