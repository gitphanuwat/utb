@extends('layouts.template')
@section('title','กลุ่มงานวิจัย/ปัญหาชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('styles')
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">
@endsection
@section('body')
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลกลุ่มงานวิจัย/ปัญหาชุมชน</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
              </div>
              <!-- /.box-body -->
            </div>

            <div id='showdetail'>
            <!-- form start -->
            <form role="form" id="form_data" name="form_data">
              <div class="box-body">
                <div class="form-group">
                  <label>กลุ่มงานวิจัย/กลุ่มปัญหา</label>
                  <input type="text" class="form-control" name="groupname" id="groupname" placeholder="กลุ่มงานวิจัย/กลุ่มปัญหา">
                </div>
                <div class="form-group">
                  <label>รายละเอียดอื่นๆ</label>
                  <textarea class="textarea" id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
@endsection
@section('script')

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

<script type="text/javascript">
	$('#detail').wysihtml5();
</script>

@endsection
