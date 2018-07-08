@extends('layouts.template')
@section('title','ข้อมูลนักวิจัย')
@section('subtitle','รายงานข้อมูล')
@section('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">
@endsection
@section('body')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="profile-username text-left">นักวิจัย</h3>
          <p class="text-muted text-left">{{ $objres->headname.$objres->firstname." ".$objres->lastname}}</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i> ข้อมูลส่วนตัว</strong>
          <p class="text-muted">
            ศูนย์บูรณาการงานวิจัยเพื่อท้องถิ่น มหาวิทยาลัยราชภัฏอุตรดิตถ์ โทร.055-411061
          </p>
          <hr>
          <strong><i class="fa fa-book margin-r-5"></i> ความเชี่ยวชาญ</strong>
          <p class="text-muted">
            ศูนย์บูรณาการงานวิจัยเพื่อท้องถิ่น มหาวิทยาลัยราชภัฏอุตรดิตถ์ โทร.055-411061
          </p>
          <hr>
          <strong><i class="fa fa-book margin-r-5"></i> งานวิจัย</strong>
          <p class="text-muted">
            ศูนย์บูรณาการงานวิจัยเพื่อท้องถิ่น มหาวิทยาลัยราชภัฏอุตรดิตถ์ โทร.055-411061
          </p>
          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> บทความวิชาการ</strong>

          <p class="text-muted">อาคาร12 มหาวิทยาลัยราชภัฏอุตรดิตถ์ 27 ถ.อินใจมี ต.ท่าอิฐ อ.เมือง จ.อุตรดิตถ์ 53000</p>

          <hr>

          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

          <p>ข้อมูลจากระบบ LRD : Local Research Development System.</p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <a href="javascript:history.back()" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i>ย้อนกลับ</a>

    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>
  <!-- /.row -->

  @endsection

  @section('script')
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

  @endsection
