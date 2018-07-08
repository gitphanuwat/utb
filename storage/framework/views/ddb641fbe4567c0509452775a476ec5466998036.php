<?php $__env->startSection('title','เกี่ยวกับระบบ'); ?>
<?php $__env->startSection('subtitle','การปรับปรุงและพัฒนาระบบ'); ?>
<?php $__env->startSection('styles'); ?>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>

  <div class="row">
    <div class="col-md-12">

                <!-- Box Comment -->
                <div class="box box-widget">

                  <!-- /.box-header -->
                  <!-- /.box-body -->
                  <div class="displayrecord"></div>
                  <div id = 'msgname'></div>
                  <!-- /.box-footer -->
                  <?php if(Auth::user()): ?>
                  <div class="box-footer">
                    <form role="form" id="form_data" name="form_data">
                      <img class="img-responsive img-circle img-sm" src="<?php echo e(url('images/avatar/large/')); ?>/<?php echo e(Auth::user()->picture); ?>" alt="">
                      <!-- .img-push is used to add margin to elements next to floating images -->
                      <div class="img-push">
                        <textarea type="text" class="form-control input-sm" id="detail" name="detail" placeholder="รายละเอียดการอัพเดทระบบ"></textarea>
                        <div class="input-group">
                          <button type="button" class="form-control saverecord">ส่งข้อมูล</button>
                        </div>
                        <input type="hidden" name="timeup" value="<?php echo e(date('Y-m-d H:i:s')); ?>"/>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                      </div>
                    </form>
                  </div>
                  <?php endif; ?>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
    </div>
  </div>

  <?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>
<script type="text/javascript">
$(function(){
      $('#detail').wysihtml5();
      displaydata();
});

    function displaydata(){
      $.ajax({
        url : '<?php echo url('about/updatelast'); ?>',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          $('.displayrecord').html(s);
          $("#example1").DataTable(
            {
             "ordering": false,
             "pageLength": 10
             //paging: false
           }
          );
        }
      });
    }

    $('.saverecord').click(function(){
            $.ajax({
                url : '<?php echo url('about/update/'); ?>',
                type : "post",
                data : $('form#form_data').serialize(),
                success:function(re)
                {
                  if(re == 0){
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    displaydata();
                    $("#form_data")[0].reset();

                  }
                },
                error:function(err){
                    //alert(err);
                    if( err.status === 422 ) {
                      var errors = err.responseJSON; //this will get the errors response data.
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                      });
                      errorsHtml += '</ul></di>';
                      $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else{
                      $( '#msgname' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
    }) ;

    $('body').delegate('.delete','click',function(){
      if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
      var id = $(this).data('id');
      $('#msgname').html('');
      $.ajax({
          url : '<?php echo url('about/update/'); ?>'+'/'+id,
          type : "POST",
          //asyncfalse
          data : {
            '_method':'DELETE',
            '_token': '<?php echo e(csrf_token()); ?>'
          },
          success:function(re)
          {
            if(re == 0){
              displaydata();
            }
          },
          error:function(err){
              //alert(err);
              if( err.status === 422 ) {
                var errors = err.responseJSON; //this will get the errors response data.
                errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each( errors, function( key, value ) {
                  errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                });
                errorsHtml += '</ul></di>';
                $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
              }else{
                $( '#msgname' ).html( 'ERROR : '+err.status );
              }
           }
      });
    }
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>