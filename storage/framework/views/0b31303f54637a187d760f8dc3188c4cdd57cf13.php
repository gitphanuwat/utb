<?php $__env->startSection('title','ผลการนำใช้ประโยชน์'); ?>
<?php $__env->startSection('subtitle','รายงานข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h4>ชื่อเรื่อง <?php echo e($objuse->title); ?></h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <strong><i class="fa fa-map-marker"></i> รายละเอียด</strong><br>
            <?php echo $objuse->detail; ?>

          <hr>

          <strong><i class="fa fa-road"></i> พื้นที่ชุมชน</strong><br>
            <a href="profilearea?id=<?php echo e($objuse->area->id); ?>"><?php echo e($objuse->area->name); ?></a><br>
            <b>สังกัด </b>ศจค. <?php echo e($objuse->area->center->name); ?>, <?php echo e($objuse->area->center->university->name); ?>

          <hr>

          <strong><i class="fa fa-user"></i> ปัญหาที่ดำเนินการ</strong><br>
          <a href="profilepro?id=<?php echo e($objuse->problem_id); ?>">
            <?php echo e($objuse->problem->title); ?>

          </a>
          <hr>

          <strong><i class="fa fa-phone"></i> กลุ่มปัญหา</strong><br>
                <?php echo e($objuse->problem->taggroup->groupname); ?>

          <hr>

          <strong><i class="fa fa-heartbeat"></i> งานวิจัย</strong><br>
            <a href="profileresearch?id=<?php echo e(isset($objuse->research->id) ? $objuse->research->id : ''); ?>"><?php echo e(isset($objuse->research->title_th) ? $objuse->research->title_th : ''); ?></a>
          <hr>

          <strong><i class="fa  fa-pagelines"></i> ผู้เชี่ยวชาญ</strong><br>
          <a href="profileexp?id=<?php echo e(isset($objuse->expert->id) ? $objuse->expert->id : ''); ?>">
            <?php echo e(isset($objuse->expert->headname) ? $objuse->expert->headname : ''); ?><?php echo e(isset($objuse->expert->firstname) ? $objuse->expert->firstname : ''); ?> <?php echo e(isset($objuse->expert->lastname) ? $objuse->expert->lastname : ''); ?>

          </a>
          <hr>

          <strong><i class="fa fa-male"></i> งานสร้างสรรค์</strong><br>
            <a href="profilecreative?id=<?php echo e(isset($objuse->creative->id) ? $objuse->creative->id : ''); ?>">
              <?php echo e(isset($objuse->creative->title) ? $objuse->creative->title : ''); ?>

            </a>
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

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>
  <script type="text/javascript">
      $(function(){
        $('.btnprint').click(function(){
          window.print();
        });
    });
  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>