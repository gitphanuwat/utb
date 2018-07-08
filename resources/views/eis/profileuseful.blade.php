@extends('layouts.template')
@section('title','ผลการนำใช้ประโยชน์')
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
          <h4>ชื่อเรื่อง {{ $objuse->title }}</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <strong><i class="fa fa-map-marker"></i> รายละเอียด</strong><br>
            {!! $objuse->detail !!}
          <hr>

          <strong><i class="fa fa-road"></i> พื้นที่ชุมชน</strong><br>
            <a href="profilearea?id={{ $objuse->area->id }}">{{ $objuse->area->name }}</a><br>
            <b>สังกัด </b>ศจค. {{ $objuse->area->center->name }}, {{ $objuse->area->center->university->name }}
          <hr>

          <strong><i class="fa fa-user"></i> ปัญหาที่ดำเนินการ</strong><br>
          <a href="profilepro?id={{ $objuse->problem_id}}">
            {{ $objuse->problem->title }}
          </a>
          <hr>

          <strong><i class="fa fa-phone"></i> กลุ่มปัญหา</strong><br>
                {{ $objuse->problem->taggroup->groupname }}
          <hr>

          <strong><i class="fa fa-heartbeat"></i> งานวิจัย</strong><br>
            <a href="profileresearch?id={{ $objuse->research->id or ''}}">{{ $objuse->research->title_th or ''}}</a>
          <hr>

          <strong><i class="fa  fa-pagelines"></i> ผู้เชี่ยวชาญ</strong><br>
          <a href="profileexp?id={{ $objuse->expert->id or ''}}">
            {{ $objuse->expert->headname or ''}}{{ $objuse->expert->firstname or ''}} {{ $objuse->expert->lastname or ''}}
          </a>
          <hr>

          <strong><i class="fa fa-male"></i> งานสร้างสรรค์</strong><br>
            <a href="profilecreative?id={{ $objuse->creative->id or ''}}">
              {{ $objuse->creative->title or '' }}
            </a>
          <hr>

          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

          <p>ข้อมูลจากระบบ LRD : Local Research Development System.</p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <a href="javascript:history.back()" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i>ย้อนกลับ</a>

      <div class="pull-right">
        <button type="button" class="btn btn-default btnprint"><i class="fa fa-print"></i> Print</button>
      </div>

    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>
  <!-- /.row -->

  @endsection

  @section('script')
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
  <script type="text/javascript">
      $(function(){
        $('.btnprint').click(function(){
          window.print();
        });
    });
  </script>
  @endsection
