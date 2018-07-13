<?php $__env->startSection('title','กลุ่มงานวิจัย/ปัญหาชุมชน'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
        <div class="row">
       <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลกลุ่มงานวิจัย/ปัญหาชุมชน</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail">เพิ่มข้อมูล >></button>
              </div>
            </div>

          <div id='showdetail'>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <div id = 'msgname'></div>

              <form role="form" id="form_data" name="form_data">
              <div class="box-body">
                <div class="form-group" id="j">
                  <label>กลุ่มงานวิจัย/กลุ่มปัญหา</label>
                  <input type="text" class="form-control" name="groupname" id="groupname" placeholder="กลุ่มงานวิจัย/กลุ่มปัญหา">
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea class="textarea" id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                </div>

                <input type="hidden"  id="id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
              </div>
              </form>
            </div>
          </div>
          </div>
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

      $('#detail').wysihtml5();

      $('#showdetail').hide();
      //$('.btndetail').hide();
      $('.updaterecord').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#groupname').focus();
          $('#detail').html('');
      });

      $('.btncancel').click(function(){
        $("#form_data")[0].reset();
        $('#detail').html('');
          $('.updaterecord').hide();
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
      });

      displaydata();

      $('body').delegate('.edit','click',function(){
        $("#form_data")[0].reset();
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#groupname').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '<?php echo url('admin/group'); ?>'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(e)
            {
              $("#form_data")[0].reset();
              $('#id').val(e.id);
              $('#groupname').val(e.groupname);

              $('#detail').html('');
              $('#detail').html(e.detail);

            }
        });
      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.updaterecord').hide();
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $('#msgname').html('');
        $.ajax({
            url : '<?php echo url('admin/group'); ?>'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(d)
            {
              $("#form_data")[0].reset();
              $('#detail').html('');
              displaydata();
            }
        });
      }
      });
  });

      $('.saverecord').click(function(){
        //alert('hi');
          var groupname = $('#groupname').val();
          var detail = $('#detail').val();
              $.ajax({
                  url : '<?php echo url('admin/group'); ?>',
                  type : "post",
                  ////asyncfalse
                  dataType : 'json',
                  data : {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'groupname' : groupname,
                    'detail' : detail
                  },
                  success:function(re)
                  {
                    if(re == 0){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $('#detail').html('');
                    $('#groupname').focus();
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
              $("#form_data")[0].reset();
      }) ;


    $('.updaterecord').click(function(){
      //alert('d');
        var id = $('#id').val();
        var groupname = $('#groupname').val();
        var detail = $('#detail').val();
            $.ajax({
              url : '<?php echo url('admin/group'); ?>'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '<?php echo e(csrf_token()); ?>',
                  'groupname' : groupname,
                  'detail' : detail
                },
                success : function(re)
                {
                  if(re == 0){
                    $("#form_data")[0].reset();
                    displaydata();
                    $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                  }else{
                    $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                  }
                  $('.updaterecord').hide();
                  $('.saverecord').show();
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

    function displaydata(){
      $.ajax({
        url : '<?php echo url('admin/group/create'); ?>',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          $('.displayrecord').html(s);
          $("#example1").DataTable();
        }
      });
    }

</script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>