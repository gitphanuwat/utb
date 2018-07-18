@extends('layouts.template')
@section('title','แหล่งท่องเที่ยว')
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
        แหล่งท่องเที่ยว
      </h3>
    </div>
    <div class="box-body">
      <div id="map" style="height: 400px; width: 100%;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d486258.629774377!2d100.48741157093338!3d17.796605605247326!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1497232249821" width="900" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
    <!-- /.box-body-->
  </div>
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
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="box-body">
                  <span class='pull-left'><label>ตำแหน่งพื้นที่</label><div id='geo_data'><label ><font color='red'>- รอโหลดตำแหน่ง -</font></label></div></span>
                  <span class="pull-right"><button type="button" title="ตำแหน่งปัจจุบัน" class="btn btn-default" onclick="getLocation()"><i class="icon ion-android-locate"></i></button></span>
                <div id="mapedit" style="height: 300px; width: 100%;"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col col-md-5">
                        <label>ละติจูด</label>
                        <input type="text" class="form-control" id="lat" name="lat">
                    </div>
                    <div class="col col-md-5">
                        <label>ลองจิจูด</label>
                        <input type="text" class="form-control" id="lng" name="lng">
                    </div>
                    <div class="col col-md-2">
                        <label>&nbsp</label><br>
                        <button type="button" id="upgeo" class="btn btn-default" onclick="setLocation()"><i class="fa fa-refresh"></i></button>
                        <input type="hidden" class="form-control" id="zm" name="zm">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>ชื่อแหล่งท่องเที่ยว</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อแหล่งท่องเที่ยว">
                    </div>
                    <div class="form-group">
                      <label>รายละเอียด</label>
                      <input type="textarea" class="form-control" name="detail" id="detail" placeholder="รายละเอียด">
                    </div>
                    <div class="form-group">
                      <label>ที่อยู่</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
                    </div>
                    <div class="form-group">
                      <label>รูปภาพ</label>
                      <input type="text" class="form-control" name="picture" id="picture" placeholder="รูปภาพ">
                    </div>
                    <div class="form-group">
                      <label>เว็บไซต์</label>
                      <input type="text" class="form-control" name="website" id="website" placeholder="เว็บไซต์">
                    </div>
                    <div class="form-group">
                      <label>ข้อมูลติดต่อ</label>
                      <input type="text" class="form-control" name="contact" id="contact" placeholder="ข้อมูลติดต่อ">
                    </div>

                    <input type="hidden"  id="id">
                    <input type="hidden"  id="organize_id" id="organize_id" value="{{ Auth::user()->organize_id }}">
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
<script>
  var locations = <?php print_r(json_encode($data)) ?>;
  var map = new GMaps({
    el: '#map',
    lat: 17,
    lng: 100,
    zoom: 8,
  });
  $.each( locations, function( index, value ){
      map.addMarker({
          id: value.id ,
          lat: value.lat ,
          lng: value.lng ,
          title: value.name ,
          infoWindow: {
             content: 'หน่วยงาน:'+value.name
          }
      });
});
</script>

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
            url : '{!! url('managerset/tourist') !!}'+'/'+id+'/edit',
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
              $('#detail').val(e.detail);
              $('#address').val(e.address);
              $('#picture').val(e.picture);
              $('#lat').val(e.lat);
              $('#lng').val(e.lng);
              $('#zm').val(e.zm);
              $('#website').val(e.website);
              $('#contact').val(e.contact);
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
            url : '{!! url('managerset/tourist') !!}'+'/'+id,
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
        var organize_id = $('#organize_id').val();
        var name = $('#name').val();
        var detail = $('#detail').val();
        var address = $('#address').val();
        var picture = $('#picture').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var zm = $('#zm').val();
        var website = $('#website').val();
        var contact = $('#contact').val();
          //$('#new_group').val('error');
              $.ajax({
                  url : '{!! url('managerset/tourist') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'organize_id' : organize_id,
                    'name' : name,
                    'detail' : detail,
                    'address' : address,
                    'picture' : picture,
                    'lat' : lat,
                    'lng' : lng,
                    'zm' : zm,
                    'website' : website,
                    'contact' : contact
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
        var organize_id = $('#organize_id').val();
        var name = $('#name').val();
        var detail = $('#detail').val();
        var address = $('#address').val();
        var picture = $('#picture').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var zm = $('#zm').val();
        var website = $('#website').val();
        var contact = $('#contact').val();

            $.ajax({
              url : '{!! url('managerset/tourist') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'name' : name,
                  'detail' : detail,
                  'address' : address,
                  'picture' : picture,
                  'lat' : lat,
                  'lng' : lng,
                  'zm' : zm,
                  'website' : website,
                  'contact' : contact
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
        url : '{!! url('managerset/tourist/create') !!}',
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
