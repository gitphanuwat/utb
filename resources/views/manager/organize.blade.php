@extends('layouts.template')
@section('title','หน่วยงานท้องถิ่น')
@section('subtitle','จัดการข้อมูล')
@section('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">

@endsection
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-map-marker"></i> หน่วยงาน : {{ Auth::user()->organize->name }}</h3>
            </div>
            <!-- /.box-headertest -->


            <div id='showdetail'>
            <!-- form start -->

            <div id = 'msgname'></div>
            <form role="form" method="POST" id="form_data" name="form_data" enctype="multipart/form-data">
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
                <hr>
                <div class="form-group">
                  <div class="pull-right">โลโก้หน่วยงาน</div>
                  <div id='userpicture'>
                    <img class="img-responsive img-squar" src="{{url('/images/no_image.png')}}" width="90">
                  </div>
                  <input type="file" class="form-control" name="icon" id="icon" placeholder="โลโก้หน่วยงาน">
                  <input type="hidden" class="form-control" name="iconold" id="iconold">
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label>ชื่อหน่วยงาน (ภาษาอังกฤษ)</label>
                      <input type="text" class="form-control" name="title" id="title" placeholder="ใช้อ้างอิงเว็บหน่วยงาน เช่น www.ttraraditbook.com/(ชื่อหน่วยงาน)" value="{{$objorg->title or ''}}">
                    </div>
                    <div class="form-group">
                      <label>ชื่อหน่วยงาน (ภาษาไทย)</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อหน่วยงาน" value="{{$objorg->name or ''}}">
                    </div>
                    <div class="form-group" style="width:250px">
                      <label>ประเภทหน่วยงาน</label>
                      <select name="type" id="type" class="form-control">
                        <option value="1">องค์การบริหารส่วนจังหวัด</option>
                        <option value="2">เทศบาลเมือง</option>
                        <option value="3">เทศบาลตำบล</option>
                        <option value="4">องค์การบริหารส่วนตำบล</option>
                        <option value="5">การปกครองพิเศษ</option>
                        <option value="6">อื่นๆ</option>
                      </select>
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
                    {{ csrf_field() }}
                    {{ method_field('put') }}
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
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                ประวัติ
              </h3>
            </div>
            <div class="box-header">
              <div class="form-group">
                <textarea class="textarea" name="history" id="history" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
              <button type="button" class="btn btn-primary updatevision">อัพเดทข้อมูล</button>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
<!-- Google Maps -->
<script  src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- Geolocation -->
<script src="{{ asset("assets/js/geolocation.js") }}"></script>

<script type="text/javascript">
    $(function(){
      reload();
      setLocation();
  });

  function reload(){

    $('#msgname').html('');
    //('#name').focus();
    var id = $('#id').val();
    $.ajax({
        url : '{!! url('managerset/organize') !!}'+'/'+id+'/edit',
        type : "get",
        data : {
          '_token': '{{ csrf_token() }}'
        },
        success : function(e)
        {
          //alert(e.name);
          $('#id').val(e.id);
          $('#title').val(e.title);
          $('#name').val(e.name);
          $('#type').val(e.type);
          $('#address').val(e.address);
          $('#lat').val(e.lat);
          $('#lng').val(e.lng);
          $('#zm').val(e.zm);
          $('#website').val(e.website);
          $('#facebook').val(e.facebook);
          $('#tel').val(e.tel);
          $('#vision').val(e.vision);
          $('#basic').val(e.basic);
          $('#history').val(e.history);
          $('#history').wysihtml5();
          $('#iconold').val(e.icon);
          $('#userpicture').html('<img class="img-responsive img-squar" src="{{url("/images/organize")}}/'+e.icon+'" width="90">');
        },
        error:function(err){
              alert('สิทธิ์การใช้งานไม่ถูกต้อง');
         }
    });

  };

    $('.updaterecord').click(function(){
      var id = $('#id').val();
            $.ajax({
              url : '{!! url('managerset/organize') !!}'+'/'+id,
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                data:new FormData($("#form_data")[0]),
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){
                    reload();
                    setLocation();
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                  }else{
                    $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                  }
                  //$('#showdetail').hide();
                  //$('.btndetail').show();
                  //$("#form_data")[0].reset();
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

    $('.updatevision').click(function(){
        var id = $('#id').val();
        var vision = $('#vision').val();
        var basic = $('#basic').val();
        var history = $('#history').val();
        //alert(vision);

            $.ajax({
              url : '{!! url('managerset/organize/updatevision') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'vision' : vision,
                  'basic' : basic,
                  'history' : history
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){
                    reload();
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                  }
                },
                error:function(err){
                      $( '#msgname' ).html( 'ERROR : '+err.status );
                 }
            });
    }) ;
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

@endsection
