<?php $__env->startSection('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น'); ?>
<?php $__env->startSection('subtitle','การแลกเปลี่ยนเรียนรู้'); ?>
<?php $__env->startSection('styles'); ?>


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
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อบจ.</span>
                      <span class="info-box-number"><?php echo e($cresearcher); ?></span>
                      <a href="<?php echo e(url('/eis/researcher')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">เทศบาล.</span>
                      <span class="info-box-number"><?php echo e($cexpert); ?></span>
                      <a href="<?php echo e(url('/eis/researcher')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อบต.</span>
                      <span class="info-box-number"><?php echo e($cresearch); ?></span>
                      <a href="<?php echo e(url('/eis/researcher')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อื่นๆ.</span>
                      <span class="info-box-number"><?php echo e($ccreative); ?></span>
                      <a href="<?php echo e(url('/eis/researcher')); ?>" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
  </div>

  <!-- Main row -->
  <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="dist/img/user7.jpg" alt="User profile picture">

                <h3 class="profile-username text-center">สมพร สุขเลิศ</h3>

                <p class="text-muted text-center">ข้อมูลสมาชิก</p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>โพสข้อมูล</b> <a class="pull-right">3</a>
                  </li>
                  <li class="list-group-item">
                    <b>คอมเม้น</b> <a class="pull-right">9</a>
                  </li>
                  <li class="list-group-item">
                    <b>ติดตามข้อมูล</b> <a class="pull-right">13</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">ข้อมูลส่วนตัว</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> ประวัติ</strong>

                <p class="text-muted">
                  นายอดุลย์ ศรีสืบวงษ อายุ 32 ปี อาชีพ- เบอร์โทรศัพท์- อีเมล์-
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>

                <p class="text-muted">ต.แม่พูล อ.ลับแล จ.อุตรดิตถ์<br>(ผู้ใช้ทั่วไป)</p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> เรื่องที่สนใจ</strong>

                <p>
                  <span class="label label-danger">กิจกรรมชุมชน</span>
                  <span class="label label-success">ผลิตภัณฑ์ชุมชน</span>
                  <span class="label label-info">เกษตรกรรม</span>
                  <span class="label label-warning">ผลไม้ลับแล</span>
                  <span class="label label-primary">แหล่งท่องเที่ยว</span>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                <p>เป็นสมาชิกเมื่อ 8 เมษายน 2560 โพส 3 ครั้ง ถูกใจ 12 ครั้ง - -</p>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">ข้อมูลล่าสุด</a></li>
                <li><a href="#timeline" data-toggle="tab">เรื่องเด่น</a></li>
                <li><a href="#settings" data-toggle="tab">คนสนใจมาก</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image">
                          <span class="username">
                            <a href="#">อบต.ขุนฝาง</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                      <span class="description">เวลา - 7:30 PM 17 มิถุนายน 2560</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลขุนฝาง พาเด็กๆศึกษาแหล่งเรียนรู้ภายในตำบลขุนฝาง วันที่ 2 กุมภาพันธ์ 2560 เวลา 09.00.น. ณ ขุนฝางบ้านกังหัน, ขุนฝางบ้านสวนฮารีน,ขุนฝางสวนม้าโฮมเสตย์.
                    </p>
                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                          (5)</a></li>
                    </ul>

                    <input class="form-control input-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post clearfix">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="dist/img/user7.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">สมพร สุขเลิศ</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                      <span class="description">เวลา - 11:30 AM 12 มิถุนายน 2560</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      การจัดศูนย์การเรียนรู้เศรษกิจพอเพียง ที่ต้องการถ่ายทอดความรู้สู่กลุ่มชุมชน.
                    </p>

                    <form class="form-horizontal">
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-9">
                          <input class="form-control input-sm" placeholder="Response">
                        </div>
                        <div class="col-sm-3">
                          <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="dist/img/user6-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">อบต.บ่อทอง</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                          <span class="description">เวลา - 09:33 AM 9 มิถุนายน 2560</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="row margin-bottom">
                      <div class="col-sm-6">
                        <img class="img-responsive" src="dist/img/photo1.jpg" alt="Photo">
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-6">
                            <img class="img-responsive" src="dist/img/photo2.jpg" alt="Photo">
                            <br>
                            <img class="img-responsive" src="dist/img/photo3.jpg" alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <img class="img-responsive" src="dist/img/photo4.jpg" alt="Photo">
                            <br>
                            <img class="img-responsive" src="dist/img/photo5.jpg" alt="Photo">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                          (5)</a></li>
                    </ul>

                    <input class="form-control input-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <!-- The timeline -->
                  <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-red">
                            10 Feb. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-blue"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-primary btn-xs">Read more</a>
                          <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-user bg-aqua"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-comments bg-yellow"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-green">
                            3 Jan. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-camera bg-purple"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                        <div class="timeline-body">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>

                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
  <!-- /.row (main row) -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>