@extends('layouts.template')
@section('title','หน่วยงานท้องถิ่น')
@section('subtitle','จัดการข้อมูล')
@section('body')
        <div class="row">
       <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลหน่วยงานท้องถิ่น</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail">เพิ่มข้อมูล >></button>
              </div>
              <!-- /.box-body -->
            </div>

            <div id='showdetail'>
            <!-- form start -->

            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">
              <div class="box-body">
                <div class="form-group" id="j">
                  <label>เขตอำเภอ</label>
                  <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกเขตอำเภอ ---</option>
                      @foreach ($objunivs as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>ชื่อหน่วยงาน (ภาษาอังกฤษ) ใช้เป็นชื่อโฮมเพจหน่วยงาน</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="ชื่อหน่วยงาน (ภาษาอังกฤษ)">
                </div>
                <div class="form-group">
                  <label>ชื่อหน่วยงาน (ภาษาไทย)</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อหน่วยงานท้องถิ่น">
                </div>
                <div class="form-group" style="width:250px">
                  <label>รูปแบบหน่วยงาน</label>
                  <select name="type" id="type" class="form-control">
                    <option value="1">องค์การบริหารส่วนจังหวัด</option>
                    <option value="2">เทศบาลเมือง</option>
                    <option value="3">เทศบาลตำบล</option>
                    <option value="4">องค์การบริหารส่วนตำบล</option>
                    <option value="5">การปกครองพิเศษ</option>
                    <option value="6">อื่นๆ</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <textarea type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่หน่วยงาน"></textarea>
                </div>
                <div class="form-group">
                  <label>พิกัดละติจูด</label>
                  <input type="text" class="form-control" name="lat" id="lat" placeholder="ละติจูด เช่น 17.6328514">
                  <label>พิกัดลองจิจูด</label>
                  <input type="text" class="form-control" name="lng" id="lng" placeholder="ลองจิจูด เช่น 100.0907392">
                </div>
                <input type="hidden"  id="id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<script type="text/javascript">
    $(function(){
      $('#showdetail').hide();
      //$('.btndetail').hide();
      $('.updaterecord').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#amphur_id').focus();
      });
      $('.btncancel').click(function(){
          $('.updaterecord').hide();
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
      });

      displaydata();

      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#title').focus();
        var id = $(this).data('id');
        //alert(0);
        $.ajax({
            url : '{!! url('admin/organize') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.name);
              $('#id').val(e.id);
              $('#amphur_id').val(e.amphur_id);
              $('#title').val(e.title);
              $('#name').val(e.name);
              $('#type').val(e.type);
              $('#address').val(e.address);
              $('#lat').val(e.lat);
              $('#lng').val(e.lng);
            }
        });
      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.updaterecord').hide();
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $('#msgname').html('');
        $.ajax({
            url : '{!! url('admin/organize') !!}'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);
              $("#form_data")[0].reset();
              displaydata();
            }
        });
      }
      });
  });

      $('.saverecord').click(function(){
        var title = $('#title').val();
        var name = $('#name').val();
        var type = $('#type').val();
          var amphur_id = $('#amphur_id').val();
          var address = $('#address').val();
          var lat = $('#lat').val();
          var lng = $('#lng').val();
          //$('#new_group').val('error');
              //alert(0);
              $.ajax({
                  url : '{!! url('admin/organize') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'title' : title,
                    'name' : name,
                    'type' : type,
                    'amphur_id' : amphur_id,
                    'address' : address,
                    'lat' : lat,
                    'lng' : lng
                  },
                  success:function(re)
                  {
                    //alert(re);
                    if(re == 0){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $("#form_data")[0].reset();
                    $('#amphur_id').focus();
                  },
                  error:function(err){
                      //alert(err);
                      if( err.status === 422 ) {
                        var errors = err.responseJSON; //this will get the errors response data.
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each( errors, function( key, value ) {
                          errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';
                        $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                      }else{
                        $( '#msgname' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;


    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var title = $('#title').val();
        var name = $('#name').val();
        var type = $('#type').val();
        var amphur_id = $('#amphur_id').val();
        var address = $('#address').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
            //alert(0);
            $.ajax({
              url : '{!! url('admin/organize') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'title' : title,
                  'name' : name,
                  'type' : type,
                  'amphur_id' : amphur_id,
                  'address' : address,
                  'lat' : lat,
                  'lng' : lng
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){
                    displaydata();
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                  }else{
                    $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                  }
                  $('.updaterecord').hide();
                  $('.saverecord').show();
                  $("#form_data")[0].reset();
                },
                error:function(err){
                    //alert(err);
                    if( err.status === 422 ) {
                      var errors = err.responseJSON; //this will get the errors response data.
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                      });
                      errorsHtml += '</ul></di>';
                      $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else{
                      $( '#msgname' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
    }) ;

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('admin/organize/create') !!}',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.displayrecord').html(s);
          //if(re == 0){alert('save');}else{alert('not save');}
          $("#example1").DataTable();
        }
      });
    }

</script>

@endsection
