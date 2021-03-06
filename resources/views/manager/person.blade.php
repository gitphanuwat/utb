@extends('layouts.template')
@section('title','บุคลากรในหน่วยงาน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">บุคลากรในหน่วยงาน</h3>
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
    </div>
</div>
</div>

<div id='showdetail'>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">ข้อมูลบุคลากร</h3>
    </div>
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
          <!-- form start -->
          <div id = 'msgname'></div>

          <form role="form" method="POST" id="form_data" name="form_data" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group" id='j'>
                <label>คำนำหน้าชื่อ</label>
                <input type="text" class="form-control" name="headname" id="headname" placeholder="คำนำหน้าชื่อ">
              </div>
              <div class="form-group" >
                <label>ชื่อ</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ">
              </div>
              <div class="form-group" >
                <label>สกุล</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="สกุล">
              </div>
              <div class="form-group" >
                <label>ตำแหน่ง</label>
                <input type="text" class="form-control" name="position" id="position" placeholder="ตำแหน่ง">
              </div>
              <div class="form-group" >
                <label>วันที่ดำรงตำแหน่ง</label>
                <input type="text" class="form-control" name="duedate" id="duedate" placeholder="วันที่ดำรงตำแหน่ง">
              </div>
              <div class="form-group" >
                <label>ที่อยู่</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
              </div>
              <div class="form-group" >
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร">
              </div>
              <div class="form-group" >
                <label>อีเมล์</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์">
              </div>

              <input type="hidden"  id="id">
              <input type="hidden" name="organize_id" id="organize_id" value="{{ Auth::user()->organize_id }}">
              <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
              <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
              <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
              {{ csrf_field() }}
              {{ method_field('post') }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-body">
              <div class="form-group">
                <label>รูปถ่ายบุคคล</label>
                <div id='userpicture'>
                  <img class="img-responsive img-squar" src="{{url('/images/no_image.png')}}" width="250">
                </div>
                <input type="file" class="form-control" name="picture" id="picture">
                <input type="hidden" class="form-control" name="pictureold" id="pictureold">
              </div>
            </div>
          </div>
        </form>
      </div>
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
          $("#form_data")[0].reset();
          $('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/no_image.png")}}" width="250">');
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
            url : '{!! url('managerset/person') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.name);
              $('#id').val(e.id);
              $('#headname').val(e.headname);
              $('#firstname').val(e.firstname);
              $('#lastname').val(e.lastname);
              $('#position').val(e.position);
              $('#duedate').val(e.duedate);
              $('#address').val(e.address);
              $('#tel').val(e.tel);
              $('#email').val(e.email);
              $('#pictureold').val(e.picture);
              $('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/person")}}/'+e.picture+'" width="250">');
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
            url : '{!! url('managerset/person') !!}'+'/'+id,
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
              //alert(0);
              $.ajax({
                  url : '{!! url('managerset/person') !!}',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_data")[0]),
                  success:function(d)
                  {
                    if(d.check){
                      displaydata();
                      //$('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/person")}}/'+d.file+'" width="250">');
                      $('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/no_image.png")}}" width="250">');
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
      }) ;


    $('.updaterecord').click(function(){
        var id = $('#id').val();
                $.ajax({
                  url : '{!! url('managerset/personpost') !!}'+'/'+id,
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    data:new FormData($("#form_data")[0]),
                    success:function(d)
                    {
                      //alert(d.file);
                      if(d.check){
                        displaydata();
                        var url = d.file;
                        $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                        $('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/no_image.png")}}" width="250">');
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
    }) ;

    function displaydata(){
      //alert(2);
      $.ajax({
        url : '{!! url('managerset/person/create') !!}',
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
