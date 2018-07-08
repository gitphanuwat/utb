<?php $__env->startSection('title','สมาชิกผู้ใช้ระบบ'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">สมาชิกผู้ใช้ระบบ</h3>
    </div>
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
<form role="form" action="" method="POST">
    <div class="form-group">
      <label>สิทธิ์การใช้งานระบบ : ระดับ</label>
      <label><?php echo e($obj->role->title); ?></label>
        <?php
        if ($obj->university_id){
          echo '<br>มหาวิทยาลัย'.$obj->university->name;
        }
        if ($obj->center_id){
          echo '<br>ศูนย์จัดการเครือข่าย'.$obj->center->name;
        }
        if ($obj->area_id){
          echo '<br>พื้นที่ : '.$obj->area->name;
        }
        ?>

    </div>
    <div class="form-group">
    <label>ข้อมูลผู้ใช้ระบบ</label>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->headname) ? $obj->headname : ''); ?></label></span>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->firstname) ? $obj->firstname : ''); ?></label></span>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->lastname) ? $obj->lastname : ''); ?></label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ที่อยู่</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->address) ? $obj->address : ''); ?></label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->tel) ? $obj->tel : ''); ?></label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เฟสบุ๊ค</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->facebook) ? $obj->facebook : ''); ?></label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
      <span class="form-control"><label> <?php echo e(isset($obj->email) ? $obj->email : ''); ?></label></span>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> รหัสผ่าน</label></span>
      <span class="form-control"><label> ********</label></span>
    </div>
    </div>
    <button type="reset" class="btn btn-primary btncancel"> ย้อนกลับ</button>
</form>

</div>
</div>
</div>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script>

$(function() {
      var role_id = $('#role_txt_id').val();
      var university_id = $('#university_txt_id').val();
      var center_id = $('#center_txt_id').val();
      var area_id = $('#area_txt_id').val();
      $('#role_id').val(role_id);
      $('#university_id').val(university_id);
      $('#center_id').val(center_id);
      $('#area_id').val(area_id);


      $('.btncancel').click(function(){
          //window.location.replace("<?php echo e(url('univer/member')); ?>");
          window.history.back();
      });


});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>