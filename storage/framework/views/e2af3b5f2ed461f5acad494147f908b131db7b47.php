<?php $__env->startSection('title','ข่าวสาร&กิจกรรม'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>

<?php echo HTML::style('/packages/dropzone/dropzone.css'); ?>

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<link rel="stylesheet" href="<?php echo e(asset("https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css")); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข่าวสาร&กิจกรรม</h3>
            </div>
            <div class="box-body with-border">


        <div class='showdata'>

          <table id='example1' class='table table-bordered table-striped'>
            <thead>
            <tr>
              <th width='30'>ลำดับ</th>
              <th>ชื่อเรื่อง</th>
              <th>ผู้ส่ง</th>
              <th>วันที่</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
<?php
          $i=1;
          foreach ($objinfor as $key){
            echo "
            <tr>
              <td>".$i++."</td>
              <td>$key->title</td>
              <td>".$key->user->headname.$key->user->firstname.' '.$key->user->lastname."</td>
              <td>".$key->created_at."</td>
              <td>
              <button type='button' data-id='$key->id' class='btn btn-success btn-xs report'>แสดงข้อมูล</button>
              </td>
            </tr>";
          }
?>
            </tbody>
          </table>

        </div>
        <div class='showdetail'>
        </div>
      </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo HTML::script('/packages/dropzone/dropzone.js'); ?>

<?php echo HTML::script('/assets/js/dropzone-config-1.js'); ?>


<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script type="text/javascript">
    $(function(){
      $("#example1").DataTable();

      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                      event.preventDefault();
                      $(this).ekkoLightbox();
                  });

      $('#showdetail').hide();

      $('body').delegate('.report','click',function(){
          $('#showdetail').show();
          var id = $(this).data('id');
          displaydetail(id);
      });

      $('body').delegate('.btnprint','click',function(){
        window.print();
      });


  });

  function displaydetail(id){
    //alert(0);
    $.ajax({
      url : '<?php echo url('user/inforshow'); ?>'+'/'+id,
      type : "get",
      //asyncfalse
      data : {},
      success : function(s)
      {
        //alert(0);
        $('.showdetail').html(s);
      }
    });
  }

</script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset("assets/dist/js/pages/dashboard.js")); ?>"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>