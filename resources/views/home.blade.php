@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','Local Research Development')
@section('styles')
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/flat/blue.css") }}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset("assets/plugins/morris/morris.css") }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset("assets/plugins/datepicker/datepicker3.css") }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset("assets/plugins/daterangepicker/daterangepicker.css") }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">

<link rel="stylesheet" href="{{ asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css") }}">
<link rel="stylesheet" href="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css") }}">

@endsection

<?php

use App\Counter;
use App\Infor;
use App\Models\Image;

if(Auth::user()){include ('makedata.php');}
include('data.php');

$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

@section('body')
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$cresearcher}}</h3>
          <p>หน่วยงาน</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{url('/eis/researcher')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$cexpert}}</h3>
          <p>ชุมชน</p>
        </div>
        <div class="icon">
          <i class="fa fa-gears "></i>
        </div>
        <a href="{{url('/eis/expert')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$cresearch}}</h3>
          <p>สมาชิก</p>
        </div>
        <div class="icon">
          <i class="fa fa-pie-chart"></i>
        </div>
        <a href="{{url('/eis/research')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$ccreative}}</h3>
          <p>กิจกรรม</p>
        </div>
        <div class="icon">
          <i class="fa fa-bookmark-o"></i>
        </div>
        <a href="{{url('/eis/creative')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div id='showgraph2'>
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ข้อมูลระบบ (จำแนกตามหน่วยงาน)</h3>
          <div class="box-tools pull-right">
            <a href='dss/system' class='name'>
              <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
            </a>
          </div>

        </div>
        <div class="box-body with-border">
            <div class="box-body chart-responsive">
              <div class="row">
                <div class="col-md-10">
                    <div class="chart" id="bar-chart2" style="height: 300px;"></div>
                </div>
                <div class="col-md-2">
                  <ul class="chart-legend clearfix">
                  <?php

                      $i=0;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$cresearcher."</span><span style='color:".$col[$i]."'> นักวิจัย</span>
                          </label></li>";
                          $i++;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$cexpert."</span><span style='color:".$col[$i]."'> ผู้เชี่ยวชาญ</span>
                          </label></li>";
                          $i++;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$cresearch."</span><span style='color:".$col[$i]."'> งานวิจัย</span>
                          </label></li>";
                          $i++;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$ccreative."</span><span style='color:".$col[$i]."'> งานสร้างสรรค์</span>
                          </label></li>";
                          $i++;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$carea."</span><span style='color:".$col[$i]."'> พื้นที่ชุมชน</span>
                          </label></li>";
                          $i++;
                          echo "<li><label class='btn-block btn-social btn-default btn-xs'>
                          <span>".$cproblem."</span><span style='color:".$col[$i]."'> ปัญหาชุมชม</span>
                          </label></li>";
                          $i++;
                  ?>
                  </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<div id='showgraph1'>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">พื้นที่ชุมชน</h3>

      <div class="box-tools pull-right">
        <a href='eis/area' class='name'>
          <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
        </a>
      </div>
    </div>
    <div class="box-body chart-responsive">
      <div class="row">
        <div class="col-md-8">
          <div class="chart" id="bar-chart1" style="height: 250px;"></div>
        </div>
        <div class="col-md-4">
            <div class="row">
              <div class="col-md-7">
                <div class="chart-responsive">
                  <canvas id="pieChart" height="200"></canvas>
                </div>
                <small class='text-muted pull-left'><i class='fa fa-list'></i> ปัญหาเชิงพื้นที่</small>
              </div>
              <div class="col-md-5">
                <ul class="chart-legend clearfix">
                  <?php
                      $i=0;
                      foreach ($sumtag as $key => $value) {
                          echo "<li class='btn-block btn-social btn-default btn-xs btngroup'>
                          <span>".$value."</span><span style='color:".$col[$i]."'> ".mb_substr($key,0,15,'UTF-8')."..</span>
                          </li>";
                          $i++;
                      }
                  ?>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Main row -->
  <div class="row">
    <section class="col-lg-7 connectedSortable">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">พื้นที่ชุมชน</h3>
          <div class="box-tools pull-right">
            <a href='{{ url('/maps')}}' class='name'>
              <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
            </a>
          </div>
        </div>
        <div class="box-body no-padding">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="pad">
                <div id="world-map-markers" style="height: 325px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="col-lg-5 connectedSortable">
      <!-- LINE CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">สถิติการใช้ระบบ</h3>
          <div class="box-tools pull-right">
            <a href='{{url('/stat')}}' class='name'>
              <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
            </a>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="line-chart" style="height: 325px;"></div>
        </div>
      </div>
    </section>
  </div>

  <div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
      <!-- BAR CHART -->
      <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-comments-o"></i>
          <h3 class="box-title">ข่าวสาร&กิจกรรม</h3>

          <div class="box-tools pull-right">
            <a href='{{url('/infor')}}' class='name'>
              <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
            </a>
          </div>
        </div>
          <!-- Chat box -->
            <div class="box-body chat" id="chat-box">
              @foreach ($objinfor as $key)
              <!-- chat item -->
              <?php
                  //$id = $objinfor->id;
                  //$data = Infor::find($id);
                  $idfile = $key->file_id;
                  $files = Image::where('file_id', $idfile)->limit(4)->get();
              ?>
              <div class="row">
                <section class="col-lg-12 connectedSortable">

              <div class="item">
                <img src="{{ url ('images/avatar/large')}}/{{$key->user->picture}}" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$key->created_at}}</small>
                    {{$key->user->headname}}{{$key->user->firstname}} {{$key->user->lastname}}
                  </a>
                  {{$key->title}}
                </p>
                <div class="attachment">
                  <h4>เอกสารแนบ :</h4>

<?php
$display = '
<ul class="mailbox-attachments clearfix">
<div class="row">';

  @$full_size_dir = @Config::get('images.full_size');

  foreach ($files as $file) {
    $fullfile = $full_size_dir.$file->filename;
    @$size = filesize($fullfile);
    if(@is_array(getimagesize($fullfile))){
      $display .= "
       <li>
          <span class='mailbox-attachment-icon' >
            <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name' data-toggle='lightbox' data-gallery='example-gallery'>
              <img src='".url('/files').'/'.$file->filename."' alt='Attachment' height='100'>
            </a>
          </span>
          <div class='mailbox-attachment-info'>
            <i class='fa fa-camera'></i>".substr($file->original_name,0,15).'...'."
            <span class='mailbox-attachment-size'>
              ".round(($size/1000), 2)." kB
            </span>
          </div>
      </li>";

    } else {
      $display .= "
      <li>
          <span class='mailbox-attachment-icon'><i class='fa fa-file-text-o' style='font-size:96px'></i></span>
          <div class='mailbox-attachment-info'>
            <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name'><i class='fa fa-paperclip'></i> ".$file->original_name."</a>
              <span class='mailbox-attachment-size'>
              ".round(($size/1000), 2)." kB
                <a href='".url('/files').'/'.$file->filename."' class='btn btn-default btn-xs pull-right'><i class='fa fa-cloud-download'></i></a>
              </span>
          </div>
      </li>";
    }
  }

  $display .= '
  </div>
</ul>';
  echo $display;

?>
                </div>
                <!-- /.attachment -->
              </div>
            </section>
          </div>
          @endforeach
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              <div class="input-group">
                <a href="{{url('/infor')}}">แสดงทั้งหมด</a>
              </div>
            </div>
          <!-- /.box (chat box) -->
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
  </div>

@endsection

@section('script')

<script src="dist/js/pages/dashboard.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset("assets/plugins/morris/morris.min.js") }}"></script>
<!-- Sparkline -->
<script src="{{ asset("assets/plugins/sparkline/jquery.sparkline.min.js") }}"></script>
<!-- jvectormap -->
<script src="{{ asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js") }}"></script>
<script src="{{ asset("assets/plugins/jvectormap/jquery-jvectormap-th-mill.js") }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("assets/plugins/knob/jquery.knob.js") }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset("assets/plugins/daterangepicker/daterangepicker.js") }}"></script>
<script src="{{ asset("assets/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script src="{{ asset("assets/plugins/chartjs/Chart.min.js") }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<?php
  if(Auth::user()){
    include ('makedatajs.php');
  }
?>
<script src="data.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->


<script>
  $(function () {
    "use strict";
    counterhit();
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox();
    });
  });

  function counterhit(){
    $.ajax({
      url : '{!! url('/counterhit') !!}',
      type : "get",
      //asyncfalse
      data : {},
      success : function(s)
      {
        //$('#counter').html(s);
      }
    });
  }
</script>

<?php
    $objcounter = Counter::get();
    $nowdate = date("Y-m-d");
    $date=date("Y-m-d",strtotime("-6 days",strtotime($nowdate)));
    $end_date = date("Y-m-d");
        $data = "<script>";
        $data .= "var line = new Morris.Line({";
        $data .= "element: 'line-chart',";
        $data .= "resize: true,";
        $data .= "data: [";
        while (strtotime($date) <= strtotime($end_date)) {
          $objc = Counter::where('day','=',$date)->first();
          if($objc){
            $counts = $objc->total;
          }else{
            $counts=0;
          }
          $data .= "{y: '$date', item1: ".$counts."},";
          $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        $data .= "],";
        $data .= "xkey: 'y',";
        $data .= "ykeys: ['item1'],";
        $data .= "labels: ['Stat'],";
        $data .= "lineColors: ['#3c8dbc'],";
        $data .= "hideHover: 'auto',";
      $data .= "});";
    $data .= "</script>";
  echo $data;
?>


@endsection
