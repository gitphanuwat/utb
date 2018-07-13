<?php $__env->startSection('title','ผู้เชี่ยวชาญ'); ?>
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
          <h4>ผู้เชี่ยวชาญ <?php echo e($objexptor->headname.$objexptor->firstname." ".$objexptor->lastname); ?></h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-user"></i> ข้อมูลส่วนตัว</strong>
          <ul>
            <li>
            <?php echo e($objexptor->address); ?>

            </li>
            <?php if(Auth::user()): ?>
            <li>
            <?php echo e($objexptor->tel); ?>

            </li>
            <?php endif; ?>
            <li>
            <?php echo e($objexptor->email); ?>

            </li>
          </ul>
          <hr>
          <strong><i class="fa fa-user-md"></i> ความเชี่ยวชาญ</strong>
          <ol>
          <?php foreach($objexp as $obj): ?>
          <li>
            <?php echo e($obj->title_th." (".$obj->title_eng.")"); ?>

          </li>
          <?php endforeach; ?>
          </ol>
          <hr>

          <strong><i class="fa fa-map-marker"></i> ผลงานเชิงพื้นที่</strong>
          <ol>
          <?php foreach($objuse as $obj): ?>
          <li>
            พื้นที่
            <a href="profilearea?id=<?php echo e(isset($obj->area_id) ? $obj->area_id : ''); ?>">
              <?php echo e($obj->name); ?>

            </a>
            โครงการ
            <a href="profileuseful?id=<?php echo e(isset($obj->id) ? $obj->id : ''); ?>">
              <?php echo e($obj->title); ?>

            </a>
          </li>
          <?php endforeach; ?>
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