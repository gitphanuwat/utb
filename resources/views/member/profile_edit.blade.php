@extends('layouts.template')
@section('title','สมาชิกผู้ใช้ระบบ')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">สมาชิกผู้ใช้ระบบ</h3>
    </div>
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">

@include('errors.list')

<form role="form" action="{{$url}}" method="POST">
  {{ method_field($method) }}
    <div class="form-group">
      <label>สิทธิ์การใช้งานระบบ1</label>
      <select name="role_id" id="role_id" class="form-control" style="width:350px" disabled="true">
          <option value="">--- เลือกสิทธิ์สมาชิก ---</option>
          @foreach ($objsrole as $key => $value)
              <option value="{{ $key }}">{{ $value }}</option>
          @endforeach
      </select>
      <div class="displayrole">


        <?php
        if ($obj->university_id){
          echo '
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="'.$obj->university_id.'">'.$obj->university->name.'</option>
          </select>';
        }
        if ($obj->center_id){
          echo '
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="'.$obj->center_id.'">'.$obj->center->name.'</option>
          </select>';
        }
        if ($obj->area_id){
          echo '
          <select name="area_id" id="area_id" class="form-control" style="width:350px">
              <option value="'.$obj->area_id.'">'.$obj->area->name.'</option>
          </select>';
        }
        ?>


      </div>
      <input type="hidden" name="role_txt_id" id="role_txt_id" value="{{$obj->role_id or ''}}">
      <input type="hidden" name="university_txt_id" id="university_txt_id" value="{{$obj->university_id or ''}}">
      <input type="hidden" name="center_txt_id" id="center_txt_id" value="{{$obj->center_id or ''}}">
      <input type="hidden" name="area_txt_id" id="area_txt_id" value="{{$obj->area_id or ''}}">
    </div>
    <div class="form-group">
    <label>ข้อมูลนักวิจัย</label>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
      <input type="text" class="form-control" name="headname" id="headname" placeholder="คำนำหน้าชื่อ" value="{{$obj->headname or ''}}">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ" value="{{$obj->firstname or ''}}">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="สกุล" value="{{$obj->lastname or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ที่อยู่</label></span>
      <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่" value="{{$obj->address or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
      <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร" value="{{$obj->tel or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เฟสบุ๊ค</label></span>
      <input type="text" class="form-control" name="facebook" id="facebook" placeholder="เฟสบุ๊ค" value="{{$obj->facebook or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> รูปภาพ</label></span>
      <input type="text" class="form-control" name="picture" id="picture" placeholder="รูปภาพ" value="{{$obj->picture or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
      <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์" value="{{$obj->email or ''}}">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> รหัสผ่าน</label></span>
      <input type="text" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" value="{{$obj->password or ''}}">
    </div>
    </div>
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <button type="submit"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
    <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
</form>

</div>
</div>
</div>

</div>
</div>

@stop
@section('script')

<script>

$(function() {
      var role_id = $('#role_txt_id').val();
      var university_id = $('#university_txt_id').val();
      var center_id = $('#center_txt_id').val();
      var area_id = $('#area_txt_id').val();
      $('#role_id').val(role_id);
      $('#university_id').val(university_id);
      $('#center_id').val(center_id);
      $('#area_id').val(area_id);

      //load role
      $('select[name="role_id"]').on('change', function() {
        var roleID = $(this).val();
        displayrole(roleID);
      });

});

    function displayrole(roleID){
      //alert(0);
      $.ajax({
        //url : '{!! url('admin/area/create') !!}',
        //url : '{!! url('ajaxrole') !!}',
        url : '{!! url('ajaxrole') !!}'+'/'+roleID,
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.displayrole').html(s);

          $('select[name="university_id"]').on('change', function() {
            var stateID = $(this).val();
            loadselect(stateID,'');
          });
          $('select[name="center_id"]').on('change', function() {
            //alert(0);
            var stateID = $(this).val();
            loadarea(stateID,'');
          });
        }
      });
    }

    function loadselect(id,idcen){
      //alert(0);
          $.ajax({
              //url: '/research/ajax/'+stateID,
              url : '{!! url('ajax') !!}'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                //alert("TEST");
                  $('select[name="center_id"]').empty();
                  $('select[name="center_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  //$('#center_id').val(idcen);
                  //$('select[name="center_id"]').html('<option value="">--test--</option>');
              }
          });
    }

    function loadarea(id,idcen){
      //alert(9);
          $.ajax({
              //url: '/research/ajax/'+stateID,
              url : '{!! url('ajaxarea') !!}'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                //alert("TEST");
                  $('select[name="area_id"]').empty();
                  $('select[name="area_id"]').html('<option value="">-- เลือกพื้นที่ชุมชน --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="area_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  //$('#center_id').val(idcen);
                  //$('select[name="center_id"]').html('<option value="">--test--</option>');
              }
          });
    }


</script>

@stop
