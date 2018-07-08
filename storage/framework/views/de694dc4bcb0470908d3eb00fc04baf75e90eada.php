<?php $__env->startSection('title','ศูนย์จัดการเครือข่าย'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
        <div class="row">
       <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลผู้ใช้ระบบ</h3>
            </div>
            <!-- /.box-header -->
            <table id='example1' class='table table-bordered table-striped'>
              <thead>
              <tr>
                <th data-sortable='false'>ลำดับ</th>
                <th data-sortable='false'>ชื่อผู้ใช้</th>
                <th data-sortable='false'>ระดับสิทธิ์</th>
                <th data-sortable='false'>สังกัด</th>
                <th data-sortable='false'>ชื่อล็อกอิน</th>
                <th width='80' data-sortable='false'>รหัสผ่าน</th>
              </tr>
              </thead>
              <tbody>
            <?php
            $i=0;
            foreach ($obj as $key) {
              $i++;
              echo "
              <tr>
                <td>$i</td>
                <td>$key->headname.$key->firstname $key->lastname</td>
                <td>".$key->role->title;
                if($key->permit==2){
                  echo "(ผู้บริหาร)";
                }
                echo "</td>
                <td>".@$key->university->name."/".@$key->center->name."/".@$key->area->name."</td>
                <td>$key->email</td>
                <td>$key->password</td>
              </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
            ?>

          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>

<script type="text/javascript">
    $(function(){
      $("#example1").DataTable();
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>