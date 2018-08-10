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
<form role="form" action="{{$url}}" method="POST">
  {{ method_field($method) }}
    <div class="form-group">
      <label>สิทธิ์การใช้งานระบบ</label>
      <select name="role_id" id="role_id" class="form-control" style="width:350px">
          <option value="">--- เลือกสิทธิ์สมาชิก ---</option>
          @foreach ($objsrole as $key => $value)
              <option value="{{ $key }}">{{ $value }}</option>
          @endforeach
      </select>
      <div class="displayrole"></div>
      <input type="hidden" name="role_txt_id" id="role_txt_id" value="{{$obj->role_id or ''}}">
      <input type="hidden" name="amphur_txt_id" id="amphur_txt_id" value="{{$obj->amphur_id or ''}}">
      <input type="hidden" name="organize_txt_id" id="organize_txt_id" value="{{$obj->organize_id or ''}}">
      <input type="hidden" name="village_txt_id" id="village_txt_id" value="{{$obj->village_id or ''}}">
    </div>
    <div class="form-group">
    <label>ข้อมูลผู้ใช้ระบบ</label>
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
      var amphur_id = $('#amphur_txt_id').val();
      var organize_id = $('#organize_txt_id').val();
      var village_id = $('#village_txt_id').val();
      $('#role_id').val(role_id);
      $('#amphur_id').val(amphur_id);
      $('#organize_id').val(organize_id);
      $('#village_id').val(village_id);

      //load role
      $('select[name="role_id"]').on('change', function() {
        var roleID = $(this).val();
        displayrole(roleID);
      });

      $('.btncancel').click(function(){
          window.location.replace("{{url('admin/member')}}");
      });
});

    function displayrole(roleID){
      $.ajax({
        url : '{!! url('ajaxrole') !!}'+'/'+roleID,
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.displayrole').html(s);

          $('select[name="amphur_id"]').on('change', function() {
            var stateID = $(this).val();
            //createsession('suniver_id',stateID);
            loadselect(stateID,'');
          });
          $('select[name="organize_id"]').on('change', function() {
            var stateID = $(this).val();
            //createsession('sorganize_id', stateID);
            loadvillage('',stateID);
          });
        }
      });
    }

    function loadselect(id,idcen){
          $.ajax({
              url : '{!! url('ajax') !!}'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                  $('select[name="organize_id"]').empty();
                  $('select[name="organize_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="organize_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
              }
          });
    }

    function loadvillage(id, idcen){
          $.ajax({
              //url: '/research/ajax/'+stateID,
              url : '{!! url('ajaxvillage') !!}'+'/'+idcen,
              type: "get",
              dataType: "json",
              success:function(data) {
                  $('select[name="village_id"]').empty();
                  $('select[name="village_id"]').html('<option value="">-- เลือกพื้นที่ชุมชน --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
              }
          });
    }

    function createsession(name,value){
          $.ajax({
              url : '{!! url('ajax') !!}'+'/'+name+'/'+value,
              type: "get",
              //asyncfalse
          });
    }


</script>

@stop
