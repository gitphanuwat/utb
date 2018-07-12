@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header">
      <!-- tools box -->
      <div class="pull-right box-tools">
        <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
          <i class="fa fa-calendar"></i></button>
        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
          <i class="fa fa-minus"></i></button>
      </div>
      <!-- /. tools -->
      <i class="fa fa-map-marker"></i>
      <h3 class="box-title">
        หน่วยงาน
      </h3>
    </div>

    <!-- /.box-body-->
  </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">พื้นที่ชุมชน : {{ Auth::user()->center->name }}</h3>
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
            <div class="box-header with-border">
              <div class="form-group" id="j">
                <label>หน่วยงาน : </label>{{ Auth::user()->center->name }}
              </div>
            </div>
            <form role="form" id="form_data" name="form_data">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="box-body">
                  <span class='pull-left'><label>ตำแหน่งพื้นที่</label><div id='geo_data'><label ><font color='red'>- รอโหลดตำแหน่ง -</font></label></div></span>
                  <span class="pull-right"><button type="button" title="ตำแหน่งปัจจุบัน" class="btn btn-default" onclick="getLocation()"><i class="icon ion-android-locate"></i></button></span>
                <div id="mapedit" style="height: 300px; width: 100%;"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col col-md-5">
                        <label>ละติจูด</label>
                        <input type="text" class="form-control" id="lat" name="lat" value="{{$objcen->lat or ''}}">
                    </div>
                    <div class="col col-md-5">
                        <label>ลองจิจูด</label>
                        <input type="text" class="form-control" id="lng" name="lng" value="{{$objcen->lng or ''}}">
                    </div>
                    <div class="col col-md-2">
                        <label>&nbsp</label><br>
                        <button type="button" id="upgeo" class="btn btn-default" onclick="setLocation()"><i class="fa fa-refresh"></i></button>
                        <input type="hidden" class="form-control" id="zm" name="zm" value="{{$objcen->zm or ''}}">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>ชื่อหมู่บ้าน</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อหน่วยงาน" value="{{$objcen->name or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เลขที่หมู่/ถนน</label>
                      <input type="text" class="form-control" name="moo" id="moo" placeholder="เลขที่หมู่/ถนน" value="{{$objcen->moo or ''}}">
                    </div>
                    <div class="form-group">
                      <label>แขวง/ตำบล</label>
                      <input type="text" class="form-control" name="tambon" id="tambon" placeholder="แขวง/ตำบล" value="{{$objcen->tambon or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เขต/อำเภอ</label>
                      <input type="text" class="form-control" name="amphur" id="amphur" placeholder="เขต/อำเภอ" value="{{$objcen->amphur or ''}}">
                    </div>
                    <div class="form-group">
                      <label>จังหวัด</label>
                      <input type="text" class="form-control" name="province" id="province" placeholder="จังหวัด" value="{{$objcen->province or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เบอร์โทร</label>
                      <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร" value="{{$objcen->tel or ''}}">
                    </div>
                    <input type="hidden"  id="id" value="{{$objcen->id or ''}}">
                    <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                    <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
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

<script  src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- Geolocation -->
<script src="{{ asset("assets/js/geolocation.js") }}"></script>

<script type="text/javascript">
    $(function(){
      //$('#showdetail').hide();
      //$('.btndetail').hide();
      setLocation();
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
            url : '{!! url('managerset/area') !!}'+'/'+id+'/edit',
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
              $('#tambon').val(e.tambon);
              $('#amphur').val(e.amphur);
              $('#province').val(e.province);
              $('#lat').val(e.lat);
              $('#lng').val(e.lng);
              $('#zm').val(e.zm);
              $('#context').val(e.context);
              $('#people').val(e.people);
              $('#health').val(e.health);
              $('#environment').val(e.environment);
              $('#keyman').val(e.keyman);
              $('#tel').val(e.tel);
              setLocation();
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
            url : '{!! url('managerset/area') !!}'+'/'+id,
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
          var tambon = $('#tambon').val();
          var amphur = $('#amphur').val();
          var province = $('#province').val();
          var context = $('#context').val();
          var people = $('#people').val();
          var lat = $('#lat').val();
          var lng = $('#lng').val();
          var health = $('#health').val();
          var environment = $('#environment').val();
          var keyman = $('#keyman').val();
          var tel = $('#tel').val();
          //$('#new_group').val('error');
              //alert(0);
              $.ajax({
                  url : '{!! url('managerset/area') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'university_id' : 0,
                    'center_id' : 0,
                    'name' : name,
                    'tambon' : tambon,
                    'amphur' : amphur,
                    'province' : province,
                    'lat' : lat,
                    'lng' : lng,
                    'zm' : zm,
                    'context' : context,
                    'people' : people,
                    'health' : health,
                    'environment' : environment,
                    'keyman' : keyman,
                    'tel' : tel
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
        var tambon = $('#tambon').val();
        var amphur = $('#amphur').val();
        var province = $('#province').val();
        var context = $('#context').val();
        var people = $('#people').val();
        var health = $('#health').val();
        var environment = $('#environment').val();
        var keyman = $('#keyman').val();
        var tel = $('#tel').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var zm = $('#zm').val();

            //alert(0);
            $.ajax({
              url : '{!! url('managerset/area') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'university_id' : 0,
                  'center_id' : 0,
                  'name' : name,
                  'tambon' : tambon,
                  'amphur' : amphur,
                  'province' : province,
                  'context' : context,
                  'people' : people,
                  'health' : health,
                  'environment' : environment,
                  'keyman' : keyman,
                  'tel' : tel,
                  'lat' : lat,
                  'lng' : lng,
                  'zm' : zm
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


</script>

@endsection
