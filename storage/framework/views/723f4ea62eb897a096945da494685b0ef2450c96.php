<?php $__env->startSection('title','มหาวิทยาลัย'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลมหาวิทยาลัย</h3>
            </div>

            <div class='showdetail'>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width='60'>ลำดับ</th>
                      <th width='250'>มหาวิทยาลัย</th>
                      <th width='20%'>จำนวนศูนย์จัดการเครือข่าย</th>
                      <th>จำนวนชุมชน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0;?>
                    <?php foreach($objuni as $key): ?>
                      <tr>
                        <td><?php echo e(++$i); ?></td>
                        <td>
                          <a data-id="<?php echo e($key->id); ?>" href='#cen' class='btncenter'><?php echo e($key->name); ?></a>
                        </td>
                        <td><?php echo e(count($key->center)); ?></td>
                        <td><?php echo e(count($key->area)); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>

            <div class='detailcenter' id='cen'>
            <div class="box-body">
              <div class="showcenter">
              </div>
            </div>
            </div>

            <div class='detailarea' id='are'>
            <div class="box-body">
              <div class="showarea">
              </div>
            </div>
            </div>

          </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(function(){
      //displaydata();

      $('.showcenter').hide();
      $('.showarea').hide();

      $('.btncenter').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadcenter(iduni);
      });

      //$('.btnarea').click(function(){
      $('body').delegate('.btnarea','click',function(){
          $('.showarea').show();
          var idcen = $(this).data('id');
          loadarea(idcen);
          //alert(idcen);
      });

    });

    function loadcenter(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getcenter'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadarea(idcen){
      //alert(idcen);
        $.ajax({
          url : '<?php echo url('analyze/getarea'); ?>',
          type : "get",
          data : {
            'idcen' : idcen,
          },
          success : function(s)
          {
            $('.showarea').html(s);
          }
        });
  }


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>