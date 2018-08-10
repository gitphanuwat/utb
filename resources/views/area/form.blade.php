@extends('layouts.dashboard')
@section('page_heading','จัดการข้อมูล')
@section('section')

<form action="{{$url}}" method="POST">
  {{ method_field($method) }}
  <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
  <div class="form-group">
      <label>มหาวิทยาลัย</label>
      <input type="text" class="form-control" id="university_id" name="university_id" placeholder="มหาวิทยาลัย" value="{{$obj->university_id or ''}}">
      <label>ชื่อศูนย์จัดการเครือข่าย</label>
      <input type="text" class="form-control" id="center_id" name="center_id" placeholder="ชื่อศูนย์จัดการเครือข่าย" value="{{$obj->center_id or ''}}">
      <label>ชื่อพื้นที่ชุมชน</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อพื้นที่ชุมชน" value="{{$obj->name or ''}}">
      <label>หมู่</label>
      <input type="text" class="form-control" id="moo" name="moo" placeholder="หมู่" value="{{$obj->moo or ''}}">
      <label>ตำบล</label>
      <input type="text" class="form-control" id="tambon" name="tambon" placeholder="ตำบล" value="{{$obj->tambon or ''}}">
      <label>อำเภอ</label>
      <input type="text" class="form-control" id="amphur" name="amphur" placeholder="อำเภอ" value="{{$obj->amphur or ''}}">
      <label>จังหวัด</label>
      <input type="text" class="form-control" id="province" name="province" placeholder="จังหวัด" value="{{$obj->province or ''}}">
      <label>บริบท</label>
      <input type="text" class="form-control" id="context" name="context" placeholder="บริบท" value="{{$obj->context or ''}}">
      <label>จำนวนประชากร</label>
      <input type="text" class="form-control" id="people" name="people" placeholder="จำนวนประชากร" value="{{$obj->people or ''}}">
      <label>สุขภาวะ</label>
      <input type="text" class="form-control" id="health" name="health" placeholder="สุขภาวะ" value="{{$obj->health or ''}}">
      <label>สิ่งแวดล้อม</label>
      <input type="text" class="form-control" id="environment" name="environment" placeholder="สภาพสิ่งแวดล้อม" value="{{$obj->environment or ''}}">
      <label>ผู้นำกลุ่ม</label>
      <input type="text" class="form-control" id="keyman" name="keyman" placeholder="ผู้นำกลุ่ม" value="{{$obj->keyman or ''}}">
      <label>เบอร์โทรติดต่อ</label>
      <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทรศัพท์" value="{{$obj->tel or ''}}">
      <button type="submit" class="btn btn-default">Save</button>
  </div>
</form>

@stop
