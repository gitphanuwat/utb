@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">พื้นที่ชุมชน : {{ Auth::user()->university->name }}</h3>
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
                  <select name="center_id" id="center_id" class="form-control" style="width:350px">
                    <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>
                    @foreach ($objcenter as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>พื้นที่ชุมชน</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อพื้นที่ชุมชน">
                </div>
                <div class="form-group">
                  <label>ตำบล</label>
                  <input type="text" class="form-control" name="tambon" id="tambon" placeholder="ตำบล">
                </div>
                <div class="form-group">
                  <label>อำเภอ</label>
                  <input type="text" class="form-control" name="amphur" id="amphur" placeholder="อำเภอ">
                </div>
                <div class="form-group">
                  <label>จังหวัด</label>
                  <input type="text" class="form-control" name="province" id="province" placeholder="จังหวัด">
                </div>
                <div class="form-group">
                  <label>พิกัดละติจูด</label>
                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="ละติจูด เช่น 17.6328514">
                  <label>พิกัดลองจิจูด</label>
                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="ลองจิจูด เช่น 100.0907392">
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
      $('.updaterecord').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#university_id').focus();
          //$('#msgname').html('');
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
            url : '{!! url('univer/area') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              $('#id').val(e.id);
              $('#university_id').val(e.university_id);
              $('#center_id').val(e.center_id);
              $('#name').val(e.name);
              $('#tambon').val(e.tambon);
              $('#amphur').val(e.amphur);
              $('#province').val(e.province);
              $('#latitude').val(e.latitude);
              $('#longitude').val(e.longitude);
              $('#context').val(e.context);
              $('#people').val(e.people);
              $('#health').val(e.health);
              $('#environment').val(e.environment);
              $('#keyman').val(e.keyman);
              $('#tel').val(e.tel);
              loadselect(e.university_id,e.center_id);
            },
            error:function(err){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
             }
        });

        //$('#center_id').val(e.center_id);

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
            url : '{!! url('univer/area') !!}'+'/'+id,
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
          var university_id = $('#university_id').val();
          var center_id = $('#center_id').val();
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
                  url : '{!! url('univer/area') !!}',
                  type : "POST",
                  ////asyncfalse
                  //dataType : 'json',
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'university_id' : university_id,
                    'center_id' : center_id,
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
                    if(re == 0){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $("#form_data")[0].reset();
                    $('#university_id').focus();
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
                      }else if(err.status === 403){
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                          errorsHtml += '<li>สิทธิ์การใช้งานไม่ถูกต้อง</li>';
                          errorsHtml += '</ul></di>';
                        $( '#msgname' ).html( errorsHtml );
                      }else{
                        $( '#msgname' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;


    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var university_id = $('#university_id').val();
        var center_id = $('#center_id').val();
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
              url : '{!! url('univer/area') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'university_id' : university_id,
                  'center_id' : center_id,
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
                    }else if(err.status === 403){
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                        errorsHtml += '<li>สิทธิ์การใช้งานไม่ถูกต้อง</li>';
                        errorsHtml += '</ul></di>';
                      $( '#msgname' ).html( errorsHtml );
                    }else{
                      $( '#msgname' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
    }) ;

    function displaydata(){
      $.ajax({
        url : '{!! url('univer/area/create') !!}',
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

    function loadselect(id,idcen){
          $.ajax({
              url : '{!! url('ajax') !!}'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                  $('select[name="center_id"]').empty();
                  $('select[name="center_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('#center_id').val(idcen);
              }
          });
    }

</script>

@endsection
