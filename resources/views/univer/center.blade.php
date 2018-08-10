@extends('layouts.template')
@section('title','ศูนย์จัดการเครือข่าย')
@section('subtitle','จัดการข้อมูล')
@section('body')
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลศูนย์จัดการเครือข่าย : {{ Auth::user()->university->name }}</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail">เพิ่มข้อมูล >></button>
              </div>
            </div>

            <div id='showdetail'>
            <!-- form start -->

            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">
              <div class="box-body">
                <div class="form-group">
                  <label>{{ Auth::user()->university->name }}</label>
                </div>
                <div class="form-group" id="j">
                  <label>ศูนย์จัดการเครือข่าย</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อศูนย์จัดการเครือข่าย">
                </div>
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <textarea type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่ศูนย์จัดการเครือข่าย"></textarea>
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
            url : '{!! url('univer/center') !!}'+'/'+id+'/edit',
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
              $('#address').val(e.address);
            },
            error:function(err){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
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
        $.ajax({
            url : '{!! url('univer/center') !!}'+'/'+id,
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
            },
            error:function(err){
                alert('สิทธิ์การใช้งานไม่ถูกต้อง');
             }
        });
      }
      });
  });

      $('.saverecord').click(function(){
          var name = $('#name').val();
          var address = $('#address').val();
              $.ajax({
                  url : '{!! url('univer/center') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'name' : name,
                    'university_id' : 0,
                    'address' : address
                  },
                  success:function(re)
                  {
                    if(re == 0){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      alert('เกิดข้อผิดพลาด');
                    }
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


    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var name = $('#name').val();
        var address = $('#address').val();
            //alert(0);
            $.ajax({
              url : '{!! url('univer/center') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'university_id' : 0,
                  'address' : address
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('แก้ไขข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  displaydata();
                  $('.updaterecord').hide();
                  $('.saverecord').show();
                  $('#showdetail').hide();
                  $('.btndetail').show();
                  $("#form_data")[0].reset();
                }
            });
    }) ;

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('univer/center/create') !!}',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          $('.displayrecord').html(s);
          $("#example1").DataTable();
        }
      });
    }

</script>

@endsection
