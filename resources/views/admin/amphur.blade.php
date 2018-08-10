@extends('layouts.template')
@section('title','เขตอำเภอ')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลเขตอำเภอ</h3>
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
                <div class="form-group" id='j'>
                  <label>อำเภอ</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="ชื่ออำเภอ">
                </div>
                <div class="form-group" id='j'>
                  <label>อำเภอ(ตัวย่อ)</label>
                  <input type="text" class="form-control" name="shortname" id="shortname" placeholder="ชื่อตัวย่อ">
                </div>
                <div class="form-group">
                  <label>รายละเอียดอื่นๆ</label>
                  <textarea type="text" class="form-control" name="detail" id="detail" placeholder="รายละเอียด" style="height: 300px;"></textarea>
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
          $('#name').focus();
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
        $('#name').focus();
        var id = $(this).data('id');
        //alert(0);
        $.ajax({
            url : '{!! url('admin/amphur') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.name);
              $('#id').val(e.id);
              $('#name').val(e.name);
              $('#shortname').val(e.shortname);
              $('#detail').val(e.detail);
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
            url : '{!! url('admin/amphur') !!}'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(e.name);
              $("#form_data")[0].reset();
              displaydata();
            }
        });
      }
      });
  });

      $('.saverecord').click(function(){
        //validate();
        //if(validated){
        var name = $('#name').val();
        var shortname = $('#shortname').val();
          var detail = $('#detail').val();
          //$('#new_group').val('error');
              //alert(0);
              $.ajax({
                  url : '{!! url('admin/amphur') !!}',
                  type : "post",
                  ////asyncfalse
                  dataType : 'json',
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'name' : name,
                    'shortname' : shortname,
                    'detail' : detail
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
                    $('#name').focus();
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
            //}
      }) ;


    $('.updaterecord').click(function(){
      //alert(0);
      //validate();
      //if(validated){
        var id = $('#id').val();
        var name = $('#name').val();
        var shortname = $('#shortname').val();
        var detail = $('#detail').val();
            //alert(0);
            $.ajax({
              url : '{!! url('admin/amphur') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'shortname' : shortname,
                  'detail' : detail
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
        //}
    }) ;

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('admin/amphur/create') !!}',
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
