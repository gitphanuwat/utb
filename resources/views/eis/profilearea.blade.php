@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
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
          <h4>พื้นที่ชุมชน {{ $objare->name }}</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <strong><i class="fa fa-map-marker"></i> ที่อยู่</strong><br>
            ต.{{ $objare->tambon }} อ.{{ $objare->amphur }} จ.{{ $objare->province }}
          <hr>

          <strong><i class="fa fa-road"></i> บริบทชุมชน</strong><br>
            {{ $objare->context }}<br>
              <?php
                foreach ($objare->areafile as $key) {
                  if($key->filetype==1){
                    echo "<i class='fa fa-paperclip'></i>";
                    echo "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                    echo "<br>";
                  }
                }
               ?>
          <hr>

          <strong><i class="fa fa-user"></i> จำนวนประชากร</strong><br>
            {{ $objare->people }}<br>
            <?php
              foreach ($objare->areafile as $key) {
                if($key->filetype==2){
                  echo "<i class='fa fa-paperclip'></i>";
                  echo "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                  echo "<br>";
                }
              }
             ?>

          <hr>

          <strong><i class="fa fa-heartbeat"></i> ข้อมูลสุขภาพ</strong><br>
            {{ $objare->health }}<br>
            <?php
              foreach ($objare->areafile as $key) {
                if($key->filetype==3){
                  echo "<i class='fa fa-paperclip'></i>";
                  echo "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                  echo "<br>";
                }
              }
             ?>

          <hr>

          <strong><i class="fa  fa-pagelines"></i> สิ่งแวดล้อม</strong><br>
            {{ $objare->environment }}<br>
            <?php
              foreach ($objare->areafile as $key) {
                if($key->filetype==4){
                  echo "<i class='fa fa-paperclip'></i>";
                  echo "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                  echo "<br>";
                }
              }
             ?>

          <hr>

          <strong><i class="fa fa-male"></i> ผู้ประสานงาน</strong><br>
              {{ $objare->keyman }}
          <hr>

          <strong><i class="fa fa-phone"></i> เบอร์โทร</strong><br>
              {{ $objare->tel }}
          <hr>

          <strong><i class="fa fa-map-marker"></i> ปัญหาในพื้นที่</strong>
          <ol>
          @foreach ($objare->problem as $obj)
          <li>
            <a href="profilepro?id={{ $obj->id}}">
            {{ $obj->title }}
          </a>
          <?php
          if($obj->status=='1'){ $status="รอดำเนินการ";}
          else if($obj->status=='2'){ $status="กำลังดำเนินการ";}
          else if($obj->status=='3'){ $status="ดำเนินการแล้วเสร็จ";}
          ?>
          ({{@$status}})
          </li>
          @endforeach
          </ol>
          <hr>

          <strong><i class="fa fa-chain"></i> การสนับสนุนภาควิชาการ</strong>
          <ol>
          @foreach ($objuse as $obj)
          <li>
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
  </div>

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
