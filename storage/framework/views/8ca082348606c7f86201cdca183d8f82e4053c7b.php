<?php $__env->startSection('title','สำรองฐานข้อมูล'); ?>
<?php $__env->startSection('subtitle','สร้างไฟล์สำรองฐานข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">สำรองฐานข้อมูล</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <a href="<?php echo e(url('mnt/bkdbnow')); ?>" type="button" class="btn btn-primary btndetail">สำรองฐานข้อมูล</a><br><br>

<?php
            function human_filesize($bytes, $decimals = 2) {
              $sz = 'BKMGTP';
              $factor = floor((strlen($bytes) - 1) / 3);
              return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$sz[$factor];
            }

            Function listdir($start_dir='backupdb') {
              $files = array();
              if (is_dir($start_dir)) {
                $fh = opendir($start_dir);
                while (($file = readdir($fh)) !== false) {
                  # loop through the files, skipping . and .., and recursing if necessary
                  if (strcmp($file, '.')==0 || strcmp($file, '..')==0 || strcmp($file, '.DS_Store')==0 || strcmp($file, 'backupdb')==0) continue;
                  $filepath = $start_dir . '/' . $file;
                  if ( is_dir($filepath) )
                    $files = array_merge($files, listdir($filepath));
                  else
                    array_push($files, $filepath);
                }
                closedir($fh);
              } else {
                # false if the function was called with an invalid non-directory argument
                $files = false;
              }
              return $files;
            }

            $files1 = listdir("backupdb");
            //echo "<br>Count Files  ". sizeof($files1) ."  Files ";
            // ถ้าไฟล์ มี backupdb ให้แสดงรายการ ไฟล์
            if (sizeof($files1) > 0) {

?>
            <form action="<?php echo e(url('mnt/deletedb')); ?>" method="post">
            <table class='table table-bordered table-striped'>
              <thead>
                <tr>
                    <th width="20">&nbsp;</th>
                    <th width="300">ไฟล์</th>
                    <th>ขนาดไฟล์</th>
                </tr>
              </thead>
                <tr class="filename">

<?php
                foreach (scandir('backupdb') as $item) {
                    if ($item == '.' || $item == '..') continue;
                	$size = human_filesize(filesize("./backupdb/".$item))."B";
                    echo "<tr class=\"filename\">";
                    echo "    <td><input type=\"checkbox\" name=\"check_files[]\"  value=\"./backupdb/$item\"/></td>";
                    echo "  	 <td>
                    <a href='".url('/backupdb')."/"."$item'". "target='_blank'>$item</a>
                    </td>";
                    echo "    <td>$size</td>";
                  //  echo "    <td><a href=\"./backupdb/$item\" target=\"_blank\">X</a></td>";
                    echo " </tr>	";
                }
?>
            </table>
            <br>
            <input type="submit" class="btn btn-danger delete" name="delete" value="ลบไฟล์ที่เลือก"/>
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            </form>

<?php
            } //end if count my files > 0
 ?>

              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>