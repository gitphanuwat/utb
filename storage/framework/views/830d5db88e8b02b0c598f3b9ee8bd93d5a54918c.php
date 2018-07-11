<?php $__env->startSection('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น'); ?>
<?php $__env->startSection('subtitle','Local Research Development'); ?>
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
<div class="col-md-4 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="ion ion-ribbon-b"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">โครงการเด่น</span>
      <span class="info-box-number">--รายการ</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<!-- fix for small devices only -->
<div class="clearfix visible-sm-block"></div>

<div class="col-md-4 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-green"><i class="ion ion-map"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">สถานที่สำคัญ</span>
      <span class="info-box-number">--รายการ</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-md-4 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="ion ion-bag"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">ผลิตภัณฑ์ชุมชน</span>
      <span class="info-box-number">-- รายการ</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
</div>      <!-- /.row -->
<!-- Main row -->
<div class="row">
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
  <!-- Custom tabs (Charts with tabs)-->
  <!-- /.nav-tabs-custom -->
            <!-- /.box (chat box) -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">เรื่องเด่นภายในจังหวัด</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- select -->
      <div class="row">
        <!-- Left col -->
        <div class="col-lg-3">
          <div class="form-group" style="width:250px">
            <select class="form-control">
              <option>--เลือกอำเภอ--</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group" style="width:250px">
            <select class="form-control">
              <option>--เลือกตำบล--</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group" style="width:250px">
            <select class="form-control">
              <option>--เลือกหมวดหมู่--</option>
            </select>
          </div>
        </div>
      </div>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>หัวเรื่อง</th>
          <th>สถานที่</th>
          <th>ผู้รับผิดชอบ</th>
          <th>ข้อมูลติดต่อ</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>โครงการข้าวอินทรีย์</td>
          <td>บ้านหาดสองแคว หมู่ 2 ตำบลหาดสองแคว อำเภอตรอน จังหวัดอุตรดิตถ์ 53140</td>
          <td>อบต.หาดสองแคว</td>
          <td>055-496098</td>
        </tr>
        <tr>
          <td>2</td>
          <td>ถนนต้นราชพฤกษ์ที่สวยที่สุดภาคเหนือ</td>
          <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
          <td>อบต.วังแดง</td>
          <td>055491506</td>
        </tr>
        <tr>
          <td>3</td>
          <td>ศูนย์การเรียนรู้แบบพึ่งตนเอง</td>
          <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
          <td>อบต.วังแดง</td>
          <td>055491506</td>
        </tr>
        <tr>
          <td>4</td>
          <td>บ้านพักโฮมสเตย์บ้านหาดสองแคว</td>
          <td>บ้านหาดสองแคว ต.หาดสองแคว อ.ตรอน จ.อุตรดิตถ์ 53140</td>
          <td>อบต.หาดสองแคว</td>
          <td>055496098</td>
        </tr>

        <tr>
          <td>5</td>
          <td>โครงการจักรยานสานฝัน</td>
          <td>บ้านหาดสองแคว ต.หาดสองแคว อ.ตรอน จ.อุตรดิตถ์ 53140</td>
          <td>อบต.หาดสองแคว</td>
          <td>055496098</td>
        </tr>
        <tr>
          <td>6</td>
          <td>ไทยอาสาป้องกันชาติ</td>
          <td>ตำบลบ่อทอง อำเภอทองแสนขัน จังหวัด อุตรดิตถ์ 53230</td>
          <td>อบต.บ่อทอง</td>
          <td>0558240268</td>
        </tr>
        <tr>
          <td>7</td>
          <td>ศาลปู่เจ้าทิศน้อย</td>
          <td>ต.บ่อทอง อ.ทองแสนขัน จ.อุตรดิตถ์</td>
          <td>เทศบาลตำบลทองแสนขัน</td>
          <td>055418254</td>
        </tr>
        <tr>
          <td>8</td>
          <td>ฝึกอบรมอาชีพ"รำกลองยาวผู้สูงอายุ"</td>
          <td>หมู่ที่ 10 ตำบลบ่อทอง อำเภอทองแสนขัน จังหวัดอุตรดิตถ์</td>
          <td>อบต.บ่อทอง</td>
          <td>0558240268</td>
        </tr>
        <tr>
          <td>9</td>
          <td>ผลิตภัณฑ์จากเหล็กน้ำพี้</td>
          <td>บ้านน้ำพี้ หมู่ 9 ตำบลน้ำพี้ อำเภอทองแสนขัน จังหวัดอุตรดิตถ์ 53230</td>
          <td>อบต.น้ำพี้</td>
          <td>095681970</td>
        </tr>
        <tr>
          <td>10</td>
          <td>กลุ่มผลิตก๊าซชีวภาพ</td>
          <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
          <td>อบต.วังแดง</td>
          <td>055491506</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อหน่วยงาน</th>
          <th>ประเภทหน่วยงาน</th>
          <th>ที่อยู่</th>
          <th>เว็บไซต์</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>

</section>
<!-- /.Left col -->
<!-- right col (We are only adding the ID to make the widgets sortable)-->
<!-- right col -->
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