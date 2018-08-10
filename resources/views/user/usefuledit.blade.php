@extends('layouts.template')
@section('title','การใช้ประโยชน์')
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
              <h3 class="box-title">การใช้ประโยชน์</h3>
            </div>
            <!-- /.box-header -->

            <div id='showdetail'>
            <!-- form start -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="box-title">@yield('subtitle')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
            <div id = 'msgname'></div>
            <form action="{{url('user/useful/'.$data->id)}}" method="post">
              {{ method_field('PUT') }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                  <label>กลุ่มปัญหาที่ดำเนินการ</label>
                  <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกกลุ่มปัญหา ---</option>
                      @foreach ($objtag as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
                </div>

          <div class="form-group">
            <label>ข้อมูลการใช้ประโยชน์</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> หัวเรื่อง</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="หัวเรื่อง" value="{{$data->title}}">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea class="textarea" id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $data->detail !!}</textarea>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> พื้นที่ดำเนินการ</label></span>
                  <input type="text" class="form-control" name="usearea" id="usearea" placeholder="พื้นที่ดำเนินการ" value="{{ $data->usearea}}">
                </div>
                </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" > <label style="width:100px"> ผู้ประสานงาน</label></span>
            <input type="text" class="form-control" name="keyman" id="keyman" value="{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}">
          </div>
          </div>
          <input type="hidden"  id="tagid" name="tagid" value="{{$data->taggroup_id or ''}}">
          <input type="hidden"  id="id">
                <button type="submit" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="button" class="btn btn-danger btncancel" onclick="history.back()">ยกเลิก</button>
          </form>
          </div>
        </div>
      </div>

<div class='showreport'></div>
          </div>
</div>
</div>
@endsection
@section('script')
<script>
  $(function() {
    var tagid = $('#tagid').val();
    $('#taggroup_id').val(tagid);
    $('.textarea').wysihtml5();
  });
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
@endsection
