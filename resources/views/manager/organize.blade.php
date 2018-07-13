@extends('layouts.template')
@section('title','หน่วยงานท้องถิ่น')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-map-marker"></i> หน่วยงาน : {{ Auth::user()->organize->name }}</h3>
            </div>
            <!-- /.box-header -->


            <div id='showdetail'>
            <!-- form start -->

            <div id = 'msgname'></div>
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
                        <input type="text" class="form-control" id="lat" name="lat" value="{{$objorg->lat or ''}}">
                    </div>
                    <div class="col col-md-5">
                        <label>ลองจิจูด</label>
                        <input type="text" class="form-control" id="lng" name="lng" value="{{$objorg->lng or ''}}">
                    </div>
                    <div class="col col-md-2">
                        <label>&nbsp</label><br>
                        <button type="button" id="upgeo" class="btn btn-default" onclick="setLocation()"><i class="fa fa-refresh"></i></button>
                        <input type="hidden" class="form-control" id="zm" name="zm" value="{{$objorg->zm or ''}}">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>ชื่อหน่วยงาน</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อหน่วยงาน" value="{{$objorg->name or ''}}">
                    </div>
                    <div class="form-group">
                      <label>ประเภทหน่วยงาน</label>
                      <input type="text" class="form-control" name="type" id="type" placeholder="ประเภทหน่วยงาน" value="{{$objorg->type or ''}}">
                    </div>
                    <div class="form-group">
                      <label>ที่อยู่</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่" value="{{$objorg->address or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เว็บไซต์</label>
                      <input type="text" class="form-control" name="website" id="website" placeholder="เว็บไซต์" value="{{$objorg->website or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เฟสบุ๊ค</label>
                      <input type="text" class="form-control" name="facebook" id="facebook" placeholder="เฟสบุ๊ค" value="{{$objorg->facebook or ''}}">
                    </div>
                    <div class="form-group">
                      <label>เบอร์โทร</label>
                      <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร" value="{{$objorg->tel or ''}}">
                    </div>
                    <input type="hidden"  id="id" value="{{$objorg->id or ''}}">
                    <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                  </div>
            </div>
          </div>
        </form>
          </div>
          </div>


          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                วิสัยทัศน์
              </h3>
            </div>
            <div class="box-header">
              <div class="form-group">
                <textarea type="text" class="form-control" name="vision" id="vision" placeholder="วิสัยทัศน์"></textarea>
              </div>
            </div>
          </div>

          <div class="box box-warning">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                พันธกิจ
              </h3>
            </div>
            <div class="box-header">
              <div class="form-group">
                <textarea type="text" class="form-control" name="basic" id="basic" placeholder="พันธกิจ"></textarea>
              </div>
            </div>
          </div>

          <div class="box box-default">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                ประวัติ
              </h3>
            </div>
            <div class="box-header">
              <div class="form-group">
                <textarea type="text" class="form-control" name="history" id="history" placeholder="ประวัติหน่วยงาน"></textarea>
              </div>
            </div>
          </div>

          <div class="box box-default">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                บุคลากร
              </h3>
            </div>
            <div class="box-header">
              <div class="form-group">
              </div>
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

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#msgname').html('');
          getLocation();
      });


      //displaydata();

      $('body').delegate('.edit','click',function(){
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#name').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('managerset/area') !!}'+'/'+id+'/edit',
            type : "get",
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.name);
              $('#id').val(e.id);
              $('#name').val(e.name);
              $('#type').val(e.type);
              $('#address').val(e.address);
              $('#lat').val(e.lat);
              $('#lng').val(e.lng);
              $('#zm').val(e.zm);
              $('#website').val(e.website);
              $('#facebook').val(e.facebook);
              $('#tel').val(e.tel);
              setLocation();
            },
            error:function(err){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
             }
        });

      });


  });



    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var name = $('#name').val();
        var type = $('#type').val();
        var address = $('#address').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var zm = $('#zm').val();
        var website = $('#website').val();
        var facebook = $('#facebook').val();
        var tel = $('#tel').val();

            $.ajax({
              url : '{!! url('managerset/organize') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'type' : type,
                  'address' : address,
                  'lat' : lat,
                  'lng' : lng,
                  'zm' : zm,
                  'website' : website,
                  'facebook' : facebook,
                  'tel' : tel
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){
                    //displaydata();
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                  }else{
                    $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                  }
                  //$('#showdetail').hide();
                  //$('.btndetail').show();
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
