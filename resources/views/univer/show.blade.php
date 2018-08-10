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
<form role="form" action="" method="POST">
    <div class="form-group">
      <label>สิทธิ์การใช้งานระบบ : ระดับ</label>
      <label>{{$obj->role->title}}{!! $obj->permit==2? '(ผู้บริหาร)' : '' !!}</label>
        <?php
        if ($obj->university_id){
          echo '<br>มหาวิทยาลัย'.$obj->university->name;
        }
        if ($obj->center_id){
          echo '<br>ศูนย์จัดการเครือข่าย'.$obj->center->name;
        }
        if ($obj->area_id){
          echo '<br>พื้นที่ : '.$obj->area->name;
        }
        ?>

    </div>
    <div class="form-group">
    <label>ข้อมูลผู้ใช้ระบบ</label>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
      <span class="form-control"><label> {{$obj->headname or ''}}</label></span>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
      <span class="form-control"><label> {{$obj->firstname or ''}}</label></span>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
      <span class="form-control"><label> {{$obj->lastname or ''}}</label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ที่อยู่</label></span>
      <span class="form-control"><label> {{$obj->address or ''}}</label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
      <span class="form-control"><label> {{$obj->tel or ''}}</label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เฟสบุ๊ค</label></span>
      <span class="form-control"><label> {{$obj->facebook or ''}}</label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
      <span class="form-control"><label> {{$obj->email or ''}}</label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> รหัสผ่าน</label></span>
      <span class="form-control"><label> ********</label></span>
    </div>
    </div>
    <button type="reset" class="btn btn-primary btncancel"> ย้อนกลับ</button>
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


      $('.btncancel').click(function(){
        window.history.back();
      });


});


</script>

@stop
