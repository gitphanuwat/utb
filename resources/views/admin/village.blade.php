@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">พื้นที่ชุมชน</h3>
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
                <div class="form-group">
                  <label>เขตอำเภอ</label>
                  <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกเขตอำเภอ ---</option>
                      @foreach ($objamphur as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group" id="j">
                  <label>หน่วยงานท้องถิ่น</label>
                  <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกหน่วยงาน ---</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>พื้นที่ชุมชน</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อพื้นที่ชุมชน">
                </div>
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่ชุมชน">
                </div>

                <div class="form-group">
                  <label>พิกัดละติจูด</label>
                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="ละติจูด เช่น 17.6328514">
                  <label>พิกัดลองจิจูด</label>
                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="ลองจิจูด เช่น 100.0907392">
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
      //alert(0);
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

    //load organize
    $('select[name="amphur_id"]').on('change', function() {
      var stateID = $(this).val();
      loadselect(stateID,'');
    });


      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#name').focus();
        var id = $(this).data('id');

        //alert(0);
        $.ajax({
            url : '{!! url('admin/village') !!}'+'/'+id+'/edit',
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
              $('#organize_id').val(e.organize_id);
              $('#name').val(e.name);
              $('#address').val(e.address);
              $('#lat').val(e.lat);
              $('#lng').val(e.lng);

              loadselect(e.amphur_id,e.organize_id);

            }
        });

        //$('#organize_id').val(e.organize_id);

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
            url : '{!! url('admin/village') !!}'+'/'+id,
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
        var amphur_id = $('#amphur_id').val();
        var organize_id = $('#organize_id').val();
        var name = $('#name').val();
        var address = $('#address').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        //$('#new_group').val('error');
            //alert(0);
            $.ajax({
                url : '{!! url('admin/village') !!}',
                type : "POST",
                ////asyncfalse
                //dataType : 'json',
                data : {
                  '_token': '{{ csrf_token() }}',
                  'amphur_id' : amphur_id,
                  'organize_id' : organize_id,
                  'name' : name,
                  'address' : address,
                  'lat' : lat,
                  'lng' : lng
                },
                success:function(re)
                {
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
    });

    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var amphur_id = $('#amphur_id').val();
        var organize_id = $('#organize_id').val();
        var name = $('#name').val();
        var address = $('#address').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();

            //alert(0);
            $.ajax({
              url : '{!! url('admin/village') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'amphur_id' : amphur_id,
                  'organize_id' : organize_id,
                  'name' : name,
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
        url : '{!! url('admin/village/create') !!}',
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

    function loadselect(id,idcen){
          $.ajax({
              //url: '/research/ajax/'+stateID,
              url : '{!! url('ajax') !!}'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                  $('select[name="organize_id"]').empty();
                  $('select[name="organize_id"]').html('<option value="">-- เลือกหน่วยงาน --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="organize_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('#organize_id').val(idcen);
              }
          });
    }

</script>

@endsection
