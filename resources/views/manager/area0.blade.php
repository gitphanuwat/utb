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
        หมู่บ้าน
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
                  <span class='pull-left'><label>ตำแหน่งพื้นที่ผลิต</label><div id='geo_data'><label ><font color='red'>- รอโหลดตำแหน่ง -</font></label></div></span>
                <div id="mapedit" style="height: 300px; width: 100%;"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label>พิกัดละติจูด</label>
                      <input type="text" class="form-control" name="latitude" id="latitude" placeholder="ละติจูด เช่น 17.6328514">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label>พิกัดลองจิจูด</label>
                      <input type="text" class="form-control" name="longitude" id="longitude" placeholder="ลองจิจูด เช่น 100.0907392">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>ชื่อหมู่บ้าน</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อหมู่บ้าน">
                    </div>
                    <div class="form-group">
                      <label>เลขที่หมู่/ถนน</label>
                      <input type="text" class="form-control" name="moo" id="moo" placeholder="เลขที่หมู่/ถนน">
                    </div>
                    <div class="form-group">
                      <label>แขวง/ตำบล</label>
                      <input type="text" class="form-control" name="tambon" id="tambon" placeholder="แขวง/ตำบล">
                    </div>
                    <div class="form-group">
                      <label>เขต/อำเภอ</label>
                      <input type="text" class="form-control" name="amphur" id="amphur" placeholder="เขต/อำเภอ">
                    </div>
                    <div class="form-group">
                      <label>จังหวัด</label>
                      <input type="text" class="form-control" name="province" id="province" placeholder="จังหวัด">
                    </div>

                    <input type="hidden"  id="id">
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
<script>
  var locations = <?php print_r(json_encode($data)) ?>;
  var map = new GMaps({
    el: '#mapedit',
    lat: 17,
    lng: 100,
    zoom: 8,
  });
      map.addMarker({
          id: value.id ,
          lat: value.lat ,
          lng: value.lng ,
          title: value.name ,
          infoWindow: {
             content: 'หน่วยงาน:'+value.name
          }
      });
</script>
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
              $('#latitude').val(e.lat);
              $('#longitude').val(e.lng);
              $('#context').val(e.context);
              $('#people').val(e.people);
              $('#health').val(e.health);
              $('#environment').val(e.environment);
              $('#keyman').val(e.keyman);
              $('#tel').val(e.tel);
              getLocation(e.name,e.lat,e.lng);
            },
            error:function(err){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
             }
        });

      });

//var initialLocation;
function getLocation(name,lat,lng) { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    // กำหนดจุดเริ่มต้นของแผนที่
    var my_Latlng  = new GGM.LatLng(lat,lng);
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#mapedit")[0];
    // กำหนด Option ของแผนที่
    var myOptions = {
        zoom: 14, // กำหนดขนาดการ zoom
        center: my_Latlng , // กำหนดจุดกึ่งกลาง
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
    };
    map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
    // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
    if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                var pos = new GGM.LatLng(position.coords.latitude,position.coords.longitude);
                    $("#geo_data").html('<label ><font color="green">ตำแหน่งปัจจุบันของคุณ</font></label>');
                var my_Point = pos;  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
                $("#lat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                $("#lng").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                map.setCenter(pos);
                //initialLocation = new GGM.LatLng(location.latitude, location.longitude);
                setMarker(pos);
            },function() {
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
                $("#geo_data").html('<label ><font color="red">!ไม่สามารถแสดงตำแหน่งได้</font></label>');
            });
    }else{
         // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
         $("#geo_data").html('<label ><font color="red">!บราวเซอร์ไม่สนับสนุน</font></label>');
    }
    // set marker
    function setMarker(initialName) {
        var marker = new GGM.Marker({
            draggable: true,
            position: initialName,
            map: map,
            title: "คุณอยู่ที่นี่."
        });
        GGM.event.addListener(marker, 'dragend', function(event) {
            //$("#geo_data").html('lat: '+marker.getPosition().lat()+'<br />long: '+marker.getPosition().lng());
            $("#lat").val(marker.getPosition().lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lng").val(marker.getPosition().lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value

        });
    }

    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
    GGM.event.addListener(map, 'zoom_changed', function() {
        $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
    });



}

function setLocation(name,lat,lng) {
  var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
  var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
  var new_lat = $("#lat").val();
  var new_lng = $("#lng").val();
  $("#geo_data").html('<label ><font color="green">กำหนดตำแหน่งเอง</font></label>');

        GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        // กำหนดจุดเริ่มต้นของแผนที่
        var my_Latlng  = new GGM.LatLng(new_lat,new_lng);
        var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
        var my_DivObj=$("#map_canvas")[0];
        // กำหนด Option ของแผนที่
        var myOptions = {
            zoom: 14, // กำหนดขนาดการ zoom
            center: my_Latlng , // กำหนดจุดกึ่งกลาง
            mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
        };
        map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
        // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
              //var pos = new GGM.LatLng(position.coords.latitude,position.coords.longitude);
              var my_Point = my_Latlng;  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
              map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
              $("#lat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
              $("#lng").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
              $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
              map.setCenter(my_Latlng);
              //initialLocation = new GGM.LatLng(location.latitude, location.longitude);
              setMarker(my_Latlng);
  // set marker
              function setMarker(initialName) {
                  var marker = new GGM.Marker({
                      draggable: true,
                      position: initialName,
                      map: map,
                      title: "คุณอยู่ที่นี่."
                  });
                  GGM.event.addListener(marker, 'dragend', function(event) {
                      //$("#geo_data").html('lat: '+marker.getPosition().lat()+'<br />long: '+marker.getPosition().lng());
                      $("#lat").val(marker.getPosition().lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                      $("#lng").val(marker.getPosition().lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                      $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value

                  });
              }
              // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
              GGM.event.addListener(map, 'zoom_changed', function() {
                  $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
              });

            }


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

  function editLocation() { // ฟังก์ชันแสดงแผนที่
    var old_lat = $("#lat").val();
    var old_lng = $("#lng").val();

      GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
      // กำหนดจุดเริ่มต้นของแผนที่
      var my_Latlng  = new GGM.LatLng(old_lat,old_lng);
      var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
      // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
      var my_DivObj=$("#map_canvas")[0];
      // กำหนด Option ของแผนที่
      var myOptions = {
          zoom: 14, // กำหนดขนาดการ zoom
          center: my_Latlng , // กำหนดจุดกึ่งกลาง
          mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
      };
      map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
      // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
      if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(function(position){
                  var pos = new GGM.LatLng(position.coords.latitude,position.coords.longitude);
                      $("#geo_data").html('<label ><font color="green">ตำแหน่งปัจจุบันของคุณ</font></label>');
                  var my_Point = pos;  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                  map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
                  $("#lat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                  $("#lng").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                  $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                  map.setCenter(pos);
                  //initialLocation = new GGM.LatLng(location.latitude, location.longitude);
                  setMarker(pos);
              },function() {
                  // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
                  $("#geo_data").html('<label ><font color="red">!ไม่สามารถแสดงตำแหน่งได้</font></label>');
              });
      }else{
           // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
           $("#geo_data").html('<label ><font color="red">!บราวเซอร์ไม่สนับสนุน</font></label>');
      }
      // set marker
      function setMarker(initialName) {
          var marker = new GGM.Marker({
              draggable: true,
              position: initialName,
              map: map,
              title: "คุณอยู่ที่นี่."
          });
          GGM.event.addListener(marker, 'dragend', function(event) {
              //$("#geo_data").html('lat: '+marker.getPosition().lat()+'<br />long: '+marker.getPosition().lng());
              $("#lat").val(marker.getPosition().lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
              $("#lng").val(marker.getPosition().lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
              $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value

          });
      }

      // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
      GGM.event.addListener(map, 'zoom_changed', function() {
          $("#zm").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
      });
  }

      $('.saverecord').click(function(){
          var name = $('#name').val();
          var tambon = $('#tambon').val();
          var amphur = $('#amphur').val();
          var province = $('#province').val();
          var context = $('#context').val();
          var people = $('#people').val();
          var latitude = $('#latitude').val();
          var longitude = $('#longitude').val();
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
                    'latitude' : latitude,
                    'longitude' : longitude,
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
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();

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
                  'latitude' : latitude,
                  'longitude' : longitude
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
        url : '{!! url('managerset/area/create') !!}',
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
