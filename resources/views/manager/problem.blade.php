@extends('layouts.template')
@section('title','ปัญหาในชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <a class="btn btn-app">
        <span class="badge bg-blue">{{$data->where('type','1')->count()}} </span>
        <i class="fa fa-ship"></i> โครงสร้างพื้นฐานฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-green">{{$data->where('type','2')->count()}} </span>
        <i class="fa fa-briefcase"></i> อาชีพฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-yellow">{{$data->where('type','3')->count()}} </span>
        <i class="fa fa-user-md"></i> สุขภาพฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-red">{{$data->where('type','4')->count()}} </span>
        <i class="fa fa-share-alt"></i> ความรู้ฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-purple">{{$data->where('type','5')->count()}} </span>
        <i class="fa fa-users"></i> ความเข้มแข็งฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-teal">{{$data->where('type','6')->count()}} </span>
        <i class="fa fa-photo"></i> ธรรมชาติฯ
      </a>
      <a class="btn btn-app">
        <span class="badge bg-maroon">{{$data->where('type','7')->count()}} </span>
        <i class="fa fa-list-ul"></i> อื่นๆ
      </a>

  </div>
</div>

<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">หน่วยงาน : {{ Auth::user()->organize->name }}</h3>
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
            <div id = 'msgname'></div>
            <form role="form" id="form_data" name="form_data">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>หัวข้อปัญหา</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="หัวข้อปัญหา">
                    </div>
                    <div class="form-group" style="width:250px">
                      <label>กลุ่มปัญหา</label>
                      <select name="type" id="type" class="form-control">
                        <option value="1">โครงสร้างพื้นฐานชุมชน</option>
                        <option value="2">อาชีพและการมีงานทำ</option>
                        <option value="3">สุขภาพและความปลอดภัย</option>
                        <option value="4">ความรู้และการศึกษา</option>
                        <option value="5">ความเข้มแข็งของชุมชน</option>
                        <option value="6">ทรัพยากรธรรมชาติและสิ่งแวดล้อม</option>
                        <option value="7">อื่นๆ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>รายละเอียด</label>
                      <textarea type="text" class="form-control" name="detail" id="detail"></textarea>
                    </div>
                    <div class="form-group">
                      <label>ที่อยู่</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
                    </div>
                    <div class="form-group" style="width:250px">
                      <label>สถานะ</label>
                      <select name="status" id="status" class="form-control">
                        <option value="1">นำเข้าระบบ</option>
                        <option value="2">กำลังดำเนินการ</option>
                        <option value="3">ดำเนินการแล้วเสร็จ</option>
                      </select>
                    </div>
                    <input type="hidden"  id="id">
                    <input type="hidden"  id="organize_id" id="organize_id" value="{{ Auth::user()->organize_id }}">
                    <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                    <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                  </div>
            </div>
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
          $('#msgname').html('');
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
            url : '{!! url('managerset/problem') !!}'+'/'+id+'/edit',
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
              $('#type').val(e.type);
              $('#detail').val(e.detail);
              $('#address').val(e.address);
              $('#status').val(e.status);
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
        $('#msgname').html('');
        $.ajax({
            url : '{!! url('managerset/problem') !!}'+'/'+id,
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

          //$('#new_problem').val('error');
              $.ajax({
                  url : '{!! url('managerset/problem') !!}',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_data")[0]),
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
        var type = $('#type').val();
        var detail = $('#detail').val();
        var address = $('#address').val();
        var status = $('#status').val();

            $.ajax({
              url : '{!! url('managerset/problem') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'type' : type,
                  'detail' : detail,
                  'address' : address,
                  'status' : status
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
                  $('#showdetail').hide();
                  $('.btndetail').show();
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
      $.ajax({
        url : '{!! url('managerset/problem/create') !!}',
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
