@extends('layouts.template')
@section('title','ข้อมูลปัญหาชุมชน')
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
          <h4>ปัญหาชุมชนเรื่อง {{ $objpro->title}}</h4>
          <h5>สถานะ :
                    <?php
                      if($objpro->status=='1'){  echo "รอดำเนินการ";}
                      else if($objpro->status=='2'){ echo "กำลังดำเนินการ";}
                      else if($objpro->status=='3'){  echo "ดำเนินการแล้วเสร็จ";}
                    ?>
          </h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-map-marker"></i> พื้นที่ชุมชน</strong><br>
          พื้นที่ : <a href="profilearea?id={{ $objpro->area->id}}">{!! $objpro->area->name !!}</a>, ศูนย์จัดการ : {!! $objpro->area->center->name !!}, {!! $objpro->area->center->university->name !!}
          <hr>

          <strong><i class="fa fa-book margin-r-5"></i> รายละเอียด</strong><br>
          {!! $objpro->detail !!}
          <hr>
          <strong><i class="fa fa-question-circle"></i> ประเด็นปัญหา</strong><br>
          {!! $objpro->instruct !!}
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
