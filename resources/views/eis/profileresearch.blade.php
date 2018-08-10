@extends('layouts.template')
@section('title','ข้อมูลงานวิจัย')
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
          <h4>งานวิจัยรื่อง
            {{ $objres->title_th}}<br>{{ $objres->title_eng}}
          </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-user"></i> นักวิจัย</strong><br>
            หัวหน้าโครงการ :
            <a href="profile?id={{ $objres->researcher->id}}">
              {{$objres->researcher->headname}}{{$objres->researcher->firstname}} {{$objres->researcher->lastname}}
            </a><br>
            ผู้ร่วมวิจัย :
            <?php
              $string = $objres->contributor;
              $arrcon = explode(",", $string);
              foreach ($arrcon as $key) {
                if(is_numeric($key)){
                  $obj = $objresh->find($key);
                  echo '<a href="profile?id='.$key.'">'.
                  $obj->headname.$obj->firstname.' '.$obj->lastname.'</a> ';
                }
              }
            ?><br>
            ผู้เชี่ยวชาญในพื้นที่ :
            <?php
              $string = $objres->expert;
              $arrexp = explode(",", $string);
              foreach ($arrexp as $key) {
                if(is_numeric($key)){
                  $obj = $objexp->find($key);
                  echo '<a href="profileexp?id='.$key.'">'.
                  $obj->headname.$obj->firstname.' '.$obj->lastname.'</a> ';
                }
              }
            ?>
          <hr>

          <strong><i class="fa fa-flag"></i> วัตถุประสงค์</strong><br>
              {{ $objres->propose }}
          <hr>

          <strong><i class="fa  fa-quote-left"></i> คำสำคัญ</strong><br>
            {{ $objres->keyword }}
          <hr>

          <strong><i class="fa fa-keyboard-o"></i> บทคัดย่อย</strong><br>
              {{ $objres->abstract }}
          <hr>

          <strong><i class="fa fa-paperclip"></i> เอกสารงานวิจัย</strong><br>
          <ol>
          @foreach ($objres->doc as $obj)
          <li>
            <a href="../file/get/{{ $obj->file or ''}}">
              {{ $obj->title}}
            </a>
          </li>
          @endforeach
          </ol>
          <hr>

          <strong><i class="fa fa-map-marker"></i> ผลการใช้ประโยชน์ในพื้นที่</strong>
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
