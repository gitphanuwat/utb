@extends('layouts.template')
@section('title','ผู้เชี่ยวชาญ')
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
          <h4>ผู้เชี่ยวชาญ {{ $objexptor->headname.$objexptor->firstname." ".$objexptor->lastname}}</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-user"></i> ข้อมูลส่วนตัว</strong>
          <ul>
            <li>
            {{ $objexptor->address }}
            </li>
            @if(Auth::user())
            <li>
            {{ $objexptor->tel }}
            </li>
            @endif
            <li>
            {{ $objexptor->email }}
            </li>
          </ul>
          <hr>
          <strong><i class="fa fa-user-md"></i> ความเชี่ยวชาญ</strong>
          <ol>
          @foreach ($objexp as $obj)
          <li>
            {{ $obj->title_th." (".$obj->title_eng.")" }}
          </li>
          @endforeach
          </ol>
          <hr>

          <strong><i class="fa fa-map-marker"></i> ผลงานเชิงพื้นที่</strong>
          <ol>
          @foreach ($objuse as $obj)
          <li>
            พื้นที่
            <a href="profilearea?id={{ $obj->area_id or ''}}">
              {{ $obj->name}}
            </a>
            โครงการ
            <a href="profileuseful?id={{ $obj->id or ''}}">
              {{ $obj->title }}
            </a>
          </li>
          @endforeach
          </ol>
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
