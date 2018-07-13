<?php $__env->startSection('title','ตรวจสอบข้อมูลผู้ใช้'); ?>
<?php $__env->startSection('subtitle','แสดงรายการใช้งานระบบ'); ?>
<?php $__env->startSection('styles'); ?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/datepicker/datepicker3.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<?php

date_default_timezone_set('Asia/Bangkok');

?>
<div class="row">
  <section class="col-lg-9">
    <!-- LINE CHART -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">ตรวจสอบข้อมูลผู้ใช้</h3>
      </div>
      <div id="boxData" style="margin:auto;padding:10px;"></div>
      <div id="loading" align="center">
          <img src="<?php echo e(url('images/ajax-loader.gif')); ?>" align="absmiddle" />
      </div>
    </div>
  </section>
  <?php
  $enddate = date("Y-m-d");
  //$enddate=date("Y-m-d",strtotime("+1 days",strtotime($enddate)));
  $startdate=date("Y-m-d",strtotime("-30 days",strtotime($enddate)));
  ?>
  <section class="col-lg-3">
      <div class="box-body chart-responsive detail">
        <div class="form-group">
          <h3 class="box-title">เลือกเวลา</h3>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i> เริ่มต้น
            </div>
            <input type="text" class="form-control pull-left" id="datepicker1" value="<?php echo e($startdate); ?>">
          </div>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i> สิ้นสุด
            </div>
            <input type="text" class="form-control pull-left" id="datepicker2" value="<?php echo e($enddate); ?>">
          </div>
        </div>
        <button type="button" class="btn btn-primary btnupdate">อัพเดทข้อมูล</button>


      </div>
      <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
  </section>
  <?php if(Auth::user()->role->slug == 'Admin'): ?>
  <section class="col-lg-3">
      <div class="box-body chart-responsive detail">
        <div class="form-group">
          <h3 class="box-title">ลบข้อมูล</h3>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i> เริ่มต้น
            </div>
            <input type="text" class="form-control pull-left" id="datepicker3" value="<?php echo e($startdate); ?>">
          </div>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i> สิ้นสุด
            </div>
            <input type="text" class="form-control pull-left" id="datepicker4" value="<?php echo e($enddate); ?>">
          </div>
        </div>
        <button type="button" class="btn btn-danger btndel">ลบข้อมูล</button>
      </div>
      <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
  </section>
  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset("assets/plugins/datepicker/bootstrap-datepicker.js")); ?>"></script>

<script type="text/javascript">
		$(document).ready(function(){
      $('.btnback').hide();
      var startdate = $('#datepicker1').val();
      var enddate = $('#datepicker2').val();
      loadstat(startdate,enddate);

      //Date picker
      $('#datepicker1').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
      $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
      $('#datepicker3').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
      $('#datepicker4').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      $('.btnback').click(function(){
          loadstat(startdate,enddate);
          $('.btnback').hide();
          $('.detail').show();
      });

      $('.btnupdate').click(function(){
        var startdate = $('#datepicker1').val();
        var enddate = $('#datepicker2').val();
          loadstat(startdate,enddate);
      });
      $('.btndel').click(function(){
        //alert(0);
        var startdate = $('#datepicker3').val();
        var enddate = $('#datepicker4').val();
          deletestat(startdate,enddate);
      });

      $('body').delegate('.btnuserlog','click',function(){
        var iduser = $(this).data('id');
        var startdate = $('#datepicker1').val();
        var enddate = $('#datepicker2').val();
        //alert(iduser);
        $('.detail').hide();
        $('.btnback').show();
        loaduserlog(startdate,enddate,iduser);
      });

	});

    function loadstat(startdate,enddate){
      //alert(enddate);
        $.ajax({
          url : '<?php echo url('analyze/getLatest'); ?>',
          type : "get",
          //asyncfalse
          data : {
            'startdate' : startdate,
            'enddate' : enddate,
          },
          success : function(s)
          {
            $('#boxData').html(s);
            $("#example1").DataTable({
              "pageLength": 50
            });
            $("#loading").fadeOut();
          }
        });
  }

  function deletestat(startdate,enddate){
    if (confirm('ยืนยันการลบข้อมูล')){
      $.ajax({
        url : '<?php echo url('analyze/deletestat'); ?>',
        type : "get",
        data : {
          'startdate' : startdate,
          'enddate' : enddate,
        },
        success : function(s)
        {
          alert('ลบข้อมูลสำเร็จ');
          //$('#boxData').html(s);
          loadstat(startdate,enddate);
        }
      });
    }
  }
  function loaduserlog(startdate,enddate,iduser){
    //alert(iduser);
      $.ajax({
        url : '<?php echo url('analyze/getuserlog'); ?>',
        type : "get",
        //asyncfalse
        data : {
          'startdate' : startdate,
          'enddate' : enddate,
          'iduser' : iduser,
        },
        success : function(s)
        {
          $('#boxData').html(s);
          $("#example1").DataTable({
            "pageLength": 50
          });
          $("#loading").fadeOut();
        }
      });
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>