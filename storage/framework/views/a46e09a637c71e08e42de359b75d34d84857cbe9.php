<?php $__env->startSection('title','การใช้ประโยชน์'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/select2/select2.min.css")); ?>">
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">การใช้ประโยชน์</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล</button>
              </div>
            </div>

          <div id='showdetail'>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">

                <div class="form-group">
                  <label>ข้อมูลการใช้ประโยชน์</label>
                </div>
                <div class="form-group">
                  <label>พื้นที่ชุมชนที่ดำเนินการ</label>
                  <select name="area_id" id="area_id" class="form-control select2" style="width:350px">
                      <option value="">--- เลือกพื้นที่ชุมชน ---</option>
                      <?php foreach($objare as $key): ?>
                          <option value="<?php echo e($key->id); ?>"><?php echo e($key->name); ?> (ศจค.<?php echo e($key->center->name); ?>)</option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>ปัญหาที่ดำเนินการ</label>
                  <select name="problem_id" id="problem_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกปัญหาชุมชน ---</option>
                  </select>
                </div>


                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> หัวเรื่อง</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="หัวเรื่อง">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea class="textarea" id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                </div>


          <div class="form-group">
            <label>งานวิจัยที่ใช้ดำเนินการ</label>
            <select name="research_id" id="research_id" class="form-control select2" style="width:350px">
                <option value="">--- เลือกงานวิจัย ---</option>
                <?php foreach($objres as $key => $value): ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>ผู้เชี่ยวชาญที่ดำเนินการ</label>
            <select name="expert_id" id="expert_id" class="form-control select2" style="width:350px">
                <option value="">--- เลือกผู้เชี่ยวชาญ ---</option>
                <?php foreach($objexp as $key): ?>
                    <option value="<?php echo e($key->id); ?>"><?php echo e($key->headname); ?><?php echo e($key->firstname); ?><?php echo e($key->lastname); ?></option>
                <?php endforeach; ?>
            </select>
          </div>

            <div class="form-group">
              <label>งานสร้างสรรค์ที่ใช้</label>
              <select name="creative_id" id="creative_id" class="form-control select2" style="width:350px">
                  <option value="">--- งานสร้างสรรค์ ---</option>
                  <?php foreach($objcre as $key => $value): ?>
                      <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                  <?php endforeach; ?>
              </select>
            </div>

            <input type="hidden"  id="university_id" name="university_id" value="">
            <input type="hidden"  id="user_id" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
          <input type="hidden"  id="id">
                <button type="button"  class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
            </form>
          </div>
        </div>
      </div>
<div class='showreport'></div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- Select2 -->
<script src="<?php echo e(asset("assets/plugins/select2/select2.full.min.js")); ?>"></script>

<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>

<script type="text/javascript">
    $(function(){
      //Initialize Select2 Elements
      //$(".select2").select2();

      $('#detail').wysihtml5();

      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.updaterecord').hide();

      //load problem
      $('select[name="area_id"]').on('change', function() {
        var stateID = $(this).val();
        loadproblem(stateID,'');
      });

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#detail').html('');
          $('.saverecord').show();
          $('.showreport').hide();
          $(".select2").select2();
          $('#title').focus();
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

      $('body').delegate('.report','click',function(){
          $('.showreport').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
          $("#form_data")[0].reset();
          var id = $(this).data('id');
          displayreport(id);
      });

      $('body').delegate('.btnedit','click',function(){
        $('.showreport').hide();
        $("#form_data")[0].reset();
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');



        $('#name').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '<?php echo url('user/useful'); ?>'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(e)
            {
              $("#form_data")[0].reset();

              $('#id').val(e.id);
              $('#area_id').val(e.area_id);

              $('#title').val(e.title);

              $('#detail').html('');

              $('#detail').html(e.detail);

              $('#research_id').val(e.research_id);
              $('#expert_id').val(e.expert_id);
              $('#creative_id').val(e.creative_id);
              loadproblem(e.area_id,e.problem_id);
              $('#problem_id').val(e.problem_id);
                    $(".select2").select2();
            }
        });
      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        //$('.saverecord').show();
        $('.showreport').hide();
        $('#showdetail').hide();
        $('.btndetail').show();
        $.ajax({
            url : '<?php echo url('user/useful'); ?>'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(d)
            {
              //alert(d);
              $("#form_data")[0].reset();
              $('#detail').html('');
              displaydata();
              $( '#cuseful' ).html(d.objs);
            }
        });
      }
      });

  });

      $('.saverecord').click(function(){
          var title = $('#title').val();
          var detail = $('#detail').val();

          var research_id = $('#research_id').val();
          var expert_id = $('#expert_id').val();
          var creative_id = $('#creative_id').val();
          var area_id = $('#area_id').val();
          var problem_id = $('#problem_id').val();
          var user_id = $('#user_id').val();
              $.ajax({
                  url : '<?php echo url('user/useful'); ?>',
                  type : "POST",
                  data : {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'title' : title,
                    'detail' : detail,

                    'research_id' : research_id,
                    'expert_id' : expert_id,
                    'creative_id' : creative_id,
                    'area_id' : area_id,
                    'problem_id' : problem_id,
                    'user_id' : user_id,
                  },
                  success:function(re)
                  {
                    if(re.check){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $('#detail').html('');
                    $('#title').focus();
                    $( '#cuseful' ).html(re.objs);
                  },
                  error:function(err){
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
              $(".select2").select2();

      }) ;

      $('.updaterecord').click(function(){
        var id = $('#id').val();
        var title = $('#title').val();
        var detail = $('#detail').val();

        var research_id = $('#research_id').val();
        var expert_id = $('#expert_id').val();
        var creative_id = $('#creative_id').val();
        var area_id = $('#area_id').val();
        var problem_id = $('#problem_id').val();
              $.ajax({
                url : '<?php echo url('user/useful'); ?>'+'/'+id,
                  type : "post",
                  //asyncfalse
                  data : {
                    '_method':'PUT',
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'title' : title,
                    'detail' : detail,
                    'research_id' : research_id,
                    'expert_id' : expert_id,
                    'creative_id' : creative_id,
                    'area_id' : area_id,
                    'problem_id' : problem_id,
                  },
                  success : function(re)
                  {
                    if(re == 0){
                      $("#form_data")[0].reset();
                      displaydata();
                      $('.updaterecord').hide();
                      $('.saverecord').show();

                      $('#showdetail').hide();
                      $('.btndetail').show();
                      alert('แก้ไขข้อมูลสำเร็จ');
                  }else{alert('เกิดข้อผิดพลาด');}
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
        url : '<?php echo url('user/useful/create'); ?>',
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

    function displayreport(id){
      $.ajax({
        url : '<?php echo url('user/useful'); ?>'+'/'+id,
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          $('.showreport').html(s);
        }
      });
    }

    function loadproblem(id,problemid){
          $.ajax({
              url : '<?php echo url('ajax'); ?>'+'/problem/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                  $('select[name="problem_id"]').empty();
                  $('select[name="problem_id"]').html('<option value="">-- เลือกปัญหาชุมชน --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="problem_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('#problem_id').val(problemid);
              }
          });
    }

</script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>