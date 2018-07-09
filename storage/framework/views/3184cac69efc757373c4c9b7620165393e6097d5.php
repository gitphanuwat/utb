<?php $__env->startSection('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น'); ?>
<?php $__env->startSection('subtitle','Local Research Development'); ?>
<?php $__env->startSection('styles'); ?>
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/iCheck/flat/blue.css")); ?>">
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/morris/morris.css")); ?>">
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css")); ?>">
<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/datepicker/datepicker3.css")); ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/daterangepicker/daterangepicker.css")); ?>">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">

<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css")); ?>">
<link rel="stylesheet" href="<?php echo e(asset("https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css")); ?>">

<?php $__env->stopSection(); ?>

<?php

use App\Counter;
use App\Infor;
use App\Models\Image;

if(Auth::user()){include ('makedata.php');}
include('data.php');

$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

<?php $__env->startSection('body'); ?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo e($cresearcher); ?></h3>
          <p>หน่วยงาน</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?php echo e(url('/eis/researcher')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo e($cexpert); ?></h3>
          <p>ชุมชน</p>
        </div>
        <div class="icon">
          <i class="fa fa-gears "></i>
        </div>
        <a href="<?php echo e(url('/eis/expert')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo e($cresearch); ?></h3>
          <p>สมาชิก</p>
        </div>
        <div class="icon">
          <i class="fa fa-pie-chart"></i>
        </div>
        <a href="<?php echo e(url('/eis/research')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo e($ccreative); ?></h3>
          <p>กิจกรรม</p>
        </div>
        <div class="icon">
          <i class="fa fa-bookmark-o"></i>
        </div>
        <a href="<?php echo e(url('/eis/creative')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-8 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- /.nav-tabs-custom -->

            <!-- Chat box -->
            <div class="box box-success">
              <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">กิจกรรมชุมชน</h3>

                <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                  <div class="btn-group" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                  </div>
                </div>
              </div>

              <div class="box-body chat">

                <div class="item">
                  <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                      อดุลย์ ศรีสืบวงษ์
                    </a>
                  #สืบสานประเพณี อบต.แม่พูลจัดงานประเพณีรดน้ำดำหัวผู้สูงอายุแสดงออกถึงความเคารพความกตัญญูกตเวทีต่อผู้สูงอายุ"ขอบคุณนายกฯที่มีรางวัลพิเศษ"มาให้ผู้สูงอายุ
                  </p>
                  <div class="attachment">
                    <h4>Attachments:</h4>

                    <p class="filename">
                      <img src="dist/img/p1.png">
                    </p>
                    <p class="message">
                      <img src="dist/img/cm1.png">
                    </p>

                  </div>
                  <!-- /.attachment -->

                </div>


                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                  <img src="dist/img/user3-128x128.jpg" alt="user image" class="online">

                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                      อบต.ขุนฝาง
                    </a>
                    ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลขุนฝาง พาเด็กๆศึกษาแหล่งเรียนรู้ภายในตำบลขุนฝาง วันที่ 2 กุมภาพันธ์ 2560 เวลา 09.00.น. ณ ขุนฝางบ้านกังหัน, ขุนฝางบ้านสวนฮารีน,ขุนฝางสวนม้าโฮมเสตย์
                  </p>
                  <div class="attachment">
                    <p class="filename">
                      <img src="dist/img/c2.png">
                    </p>

                  </div>

                </div>
                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                  <img src="dist/img/user6-128x128.jpg" alt="user image" class="online">

                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 1:15</small>
                      อบต.ไร่อ้อย
                    </a>
                    พิธีเปิดศูนย์การเรียนรู้เศรษกิจพอเพียง ต.ไร่อ้อย — ที่ อบต.ไร่อ้อย
                  </p>
                  <div class="attachment">
                    <p class="filename">
                      <img src="dist/img/c3.png">
                    </p>
                  </div>
                </div>
              <div class="box-footer">
                <div class="input-group">
                  <input class="form-control" placeholder="Type message...">

                  <div class="input-group-btn">
                    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-4 connectedSortable">

            <!-- Map box -->
            <div class="box box-info">
              <div class="box-header">
                <div class="box-tools pull-right">
                  <a href='<?php echo e(url('/stat')); ?>' class='name'>
                    <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
                  </a>
                </div>
                <i class="fa fa-map-marker"></i>
                <h3 class="box-title">
                  หน่วยงาน
                </h3>
              </div>
              <div class="box-body chart-responsive">
                <div id="world-map5" style="height: 100%; width: 100%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d486258.629774377!2d100.48741157093338!3d17.796605605247326!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1497232249821" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div>
              <!-- /.box-body-->
            </div>
            <!-- /.box -->

            <!-- Calendar -->
            <div class="box box-solid bg-green-gradient">
              <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">กิจกรรมชุมชน</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#">Add new event</a></li>
                      <li><a href="#">Clear events</a></li>
                      <li class="divider"></li>
                      <li><a href="#">View calendar</a></li>
                    </ul>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-black">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- Progress bars -->
                    <div class="clearfix">
                      <span class="pull-left">อบต.น้ำพี้</span>
                    </div>
                    <div>
                      <a href="#">กิจกรรมบุญบั้งไฟ หมู่บ้าน..</a>
                    </div>

                    <div class="clearfix">
                      <span class="pull-left">อบต.บ่อทอง</span>
                    </div>
                    <div>
                      <a href="#">ตักบาทเทโววัดบ่อทอง..</a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="clearfix">
                      <span class="pull-left">อบต.ท่าสัก</span>
                    </div>
                    <div>
                      <a href="#">ประเพณีแห่นางแมว..</a>
                    </div>

                    <div class="clearfix">
                      <span class="pull-left">อบต.ชัยจุมพล</span>
                    </div>
                    <div>
                      <a href="#">แห่เทียนเข้าพรรษา..</a>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.box -->

              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">สถิติการใช้ระบบ</h3>
                  <div class="box-tools pull-right">
                    <a href='<?php echo e(url('/stat')); ?>' class='name'>
                      <small class='text-muted pull-right'><i class='fa fa-list'></i> More..</small>
                    </a>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
              </div>

            <div class="box box-info">
              <div class="box-header">
                <i class="fa fa-envelope"></i>

                <h3 class="box-title">แจ้งปัญหาชุมชน</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <div class="box-body">
                <form action="#" method="post">
                  <div class="form-group">
                    <input type="email" class="form-control" name="emailto" placeholder="ผู้ส่ง">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="หัวเรื่อง">
                  </div>
                  <div>
                    <textarea class="textarea" placeholder="ข้อความ" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </form>
              </div>
              <div class="box-footer clearfix">
                <button type="button" class="pull-right btn btn-default" id="sendEmail">ส่งข้อมูล
                  <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>

            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title">สำรวจความคิดเห็น</h3>
                <p>
                ท่านต้องการให้ชุมชนพัฒนาและแก้ไขปัญหาในด้านใดโดยเร็วมากที่สุด
              </p>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>
                    <input type="radio" name="r1" class="minimal" checked>
                    ระบบประปาประจำหมู่บ้าน
                  </label><br>
                  <label>
                    <input type="radio" name="r1" class="minimal">
                    ระบบเส้นทางสัญจรภายในชุมชน
                  </label><br>
                  <label>
                    <input type="radio" name="r1" class="minimal">
                    ระบบเสียงตามสาย
                  </label>
                  <button type="button" class="pull-right btn btn-default" id="sendEmail">ส่งข้อมูล
                    <i class="fa fa-arrow-circle-right"></i></button>

                </div>
              </div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

  <!-- Main row -->
  <div class="row">


  </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="dist/js/pages/dashboard.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo e(asset("assets/plugins/morris/morris.min.js")); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset("assets/plugins/sparkline/jquery.sparkline.min.js")); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-th-mill.js")); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset("assets/plugins/knob/jquery.knob.js")); ?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo e(asset("assets/plugins/daterangepicker/daterangepicker.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datepicker/bootstrap-datepicker.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/chartjs/Chart.min.js")); ?>"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

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
      url : '<?php echo url('/counterhit'); ?>',
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>