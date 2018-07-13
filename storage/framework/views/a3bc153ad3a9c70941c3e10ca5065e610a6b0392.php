<?php $__env->startSection('title','พื้นที่ชุมชน'); ?>
<?php $__env->startSection('subtitle','ข้อมูลแผนที่ชุมชน'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css")); ?>">
<?php $__env->stopSection(); ?>

<?php
use App\Area;

?>

<?php $__env->startSection('body'); ?>
  <!-- Main row -->
      <!-- MAP & BOX PANE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">พื้นที่ชุมชน</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <div class="pad">
                <!-- Map will be created here -->
                <div id="world-map-markers" style="height: 600px;"></div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-5 col-sm-5">
              <form role="form" id="form_data" name="form_data">
                <div class="box-body">
                  <div class="form-group">
                    <label>มหาวิทยาลัย</label>
                    <select name="university_id" id="university_id" class="form-control" style="width:350px">
                        <option value="">--- เลือกมหาวิทยาลัย ---</option>
                        <?php foreach($objunivs as $key => $value): ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>ศูนย์จัดการเครือข่าย</label>
                    <select name="center_id" id="center_id" class="form-control" style="width:350px">
                        <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>
                    </select>
                  </div>

                  <input type="hidden"  id="id">
                  <button type="button"  class="btn btn-primary btnupdate">อัพเดทแผนที่</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- jvectormap -->
<script src="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/jvectormap/jquery-jvectormap-th-mill.js")); ?>"></script>


<?php

$i=0;
$objarea = Area::get();
?>

<script type="text/javascript">
$(function(){
  loadmap('','');
  //load center
  $('select[name="university_id"]').on('change', function() {
    var stateID = $(this).val();
    loadselect(stateID,'');
  });

  $('.btnupdate').click(function(){
    var id = $('#university_id').val();
    var idcen = $('#center_id').val();
    loadmap(id,idcen);
  });


});

function loadselect(id,idcen){
      $.ajax({
          url : '<?php echo url('ajax'); ?>'+'/'+id,
          type: "GET",
          dataType: "json",
          success:function(data) {
              $('select[name="center_id"]').empty();
              $('select[name="center_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
              $.each(data, function(key, value) {
                  $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
              });
              $('#center_id').val(idcen);
          }
      });
}

function loadmap(id,idcen){
  //alert(id);
    $.ajax({
      url : '<?php echo url('ajaxmap'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
        'idcen' : idcen,
      },
      success : function(s)
      {
        $('#world-map-markers').html(s);
      }
    });
}




</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>