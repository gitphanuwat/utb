<?php $__env->startSection('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น'); ?>
<?php $__env->startSection('subtitle','แหล่งท่องเที่ยว'); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php
include('data.php');
?>
<?php $__env->startSection('body'); ?>
<div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">จำนวนประชากร</span>
            <span class="info-box-number">ทั้งหมด --</span>
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
          <span class="info-box-icon bg-green"><i class="fa fa-camera-retro"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">แหล่งท่องเที่ยว</span>
            <span class="info-box-number">--รายการ</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-question"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ปัญหาชุมชน</span>
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
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                หมู่บ้าน
              </h3>
            </div>
            <div class="box-body">
              <div id="map" style="height: 400px; width: 100%;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d486258.629774377!2d100.48741157093338!3d17.796605605247326!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1497232249821" width="900" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box (chat box) -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ข้อมูลชุมชนภายในจังหวัด</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- select -->
              <div class="form-group" style="width:250px">
                <select class="form-control">
                  <option>--เลือกอำเภอ--</option>
                </select>
                <select class="form-control">
                  <option>--เลือกตำบล--</option>
                </select>

              </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อหมู่บ้าน</th>
                  <th>สังกัด</th>
                  <th>ที่อยู่</th>
                  <th>ผู้นำ/ผู้ใหญ่บ้าน</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>บ้านห้วยโป่ง</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.1 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายบอย กิจมี</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>บ้านช่องลม</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.2 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายอดิเรก พรมฤทธิ์</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>บ้านหาดงื้ว</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.3 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายวิรัช ลาดทะ</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>บ้านหาดงื้ว</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.4 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายสมศักดิ์ พลพิพัฒน์</td>
                </tr>

                <tr>
                  <td>5</td>
                  <td>บ้านวังแดง</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.5 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายบรรลุ อินทร์เพ็ญ</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>บ้านนาน้อย</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.6 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายกิตติศักดิ์ เรืองมั่น</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>บ้านดอนตาดำ</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.7 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นางสาวกัญจนา เหล็กโป้</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>บ้านไร่</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.8 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายบุญลือ วันเอก</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>บ้านนาตารอด</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.9 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นางวาสนา ผิวละออง</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>บ้านนาใต้</td>
                  <td>อบต.หาดงิ้ว</td>
                  <td>ม.10 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
                  <td>นายกลกมล จิ๋วอยู่</td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script>
  var locations = <?php print_r(json_encode($locations)) ?>;
  var map = new GMaps({
    el: '#map',
    lat: 17,
    lng: 100,
    zoom: 8,
  });
  $.each( locations, function( index, value ){
      map.addMarker({
          id: value.id ,
          lat: value.lat ,
          lng: value.lng ,
          title: value.city ,
          infoWindow: {
             content: 'หน่วยงาน:'+value.city
          }
      });
});
</script>
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