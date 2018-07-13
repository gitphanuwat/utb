<?php $__env->startSection('title','ข้อมูลปัญหาชุมชน'); ?>
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
          <h4>ปัญหาชุมชนเรื่อง <?php echo e($objpro->title); ?></h4>
          <h5>สถานะ :
                    <?php
                      if($objpro->status=='1'){  echo "รอดำเนินการ";}
                      else if($objpro->status=='2'){ echo "กำลังดำเนินการ";}
                      else if($objpro->status=='3'){  echo "ดำเนินการแล้วเสร็จ";}
                    ?>
          </h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-map-marker"></i> พื้นที่ชุมชน</strong><br>
          พื้นที่ : <a href="profilearea?id=<?php echo e($objpro->area->id); ?>"><?php echo $objpro->area->name; ?></a>, ศูนย์จัดการ : <?php echo $objpro->area->center->name; ?>, <?php echo $objpro->area->center->university->name; ?>

          <hr>

          <strong><i class="fa fa-book margin-r-5"></i> รายละเอียด</strong><br>
          <?php echo $objpro->detail; ?>

          <hr>
          <strong><i class="fa fa-question-circle"></i> ประเด็นปัญหา</strong><br>
          <?php echo $objpro->instruct; ?>

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