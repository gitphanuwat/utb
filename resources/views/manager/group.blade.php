@extends('layouts.template')
@section('title','กลุ่มชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-6">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="ion ion-pricetags"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ระดับจังหวัด</span>
        <span class="info-box-number">{{$data->where('type','1')->count()}} กลุ่ม</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-6">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-pricetags"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ระดับอำเภอ</span>
        <span class="info-box-number">{{$data->where('type','2')->count()}} กลุ่ม</span>
      </div>
    </div>
  </div>
  <!-- /.col -->
  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-6">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion-pricetag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ระดับตำบล</span>
        <span class="info-box-number">{{$data->where('type','3')->count()}} กลุ่ม</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-6">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion-location"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ระดับหมู่บ้าน</span>
        <span class="info-box-number">{{$data->where('type','4')->count()}} กลุ่ม</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>      <!-- /.row -->

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
                      <label>ชื่อกลุ่ม</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อกลุ่ม">
                    </div>
                    <div class="form-group" style="width:250px">
                      <label>ระดับกลุ่ม</label>
                      <select name="type" id="type" class="form-control">
                        <option value="1">ระดับจังหวัด</option>
                        <option value="2">ระดับอำเภอ</option>
                        <option value="3">ระดับตำบล</option>
                        <option value="3">ระดับชุมชน</option>
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
                    <div class="form-group">
                      <label>หัวหน้ากลุ่ม</label>
                      <input type="text" class="form-control" name="leader" id="leader" placeholder="หัวหน้ากลุ่ม">
                    </div>
                    <div class="form-group">
                      <label>ข้อมูลติดต่อ</label>
                      <input type="text" class="form-control" name="contact" id="contact" placeholder="ข้อมูลติดต่อ">
                    </div>
                    <div class="form-group">
                      <label>เบอร์โทรติดต่อ</label>
                      <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรติดต่อ">
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
<!-- Geolocation -->
<script src="{{ asset("assets/js/geolocation.js") }}"></script>

<script type="text/javascript">
    $(function(){
      $('#showdetail').hide();
      //$('.btndetail').hide();
      $('.updaterecord').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#msgname').html('');
          getLocation();
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
            url : '{!! url('managerset/group') !!}'+'/'+id+'/edit',
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
              $('#leader').val(e.leader);
              $('#contact').val(e.contact);
              $('#tel').val(e.tel);
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
            url : '{!! url('managerset/group') !!}'+'/'+id,
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

          //$('#new_group').val('error');
              $.ajax({
                  url : '{!! url('managerset/group') !!}',
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
        var leader = $('#leader').val();
        var contact = $('#contact').val();
        var tel = $('#tel').val();

            $.ajax({
              url : '{!! url('managerset/group') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'type' : type,
                  'detail' : detail,
                  'address' : address,
                  'leader' : leader,
                  'contact' : contact,
                  'tel' : tel
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
        url : '{!! url('managerset/group/create') !!}',
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
