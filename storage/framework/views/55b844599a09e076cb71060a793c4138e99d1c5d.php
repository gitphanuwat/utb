<?php $__env->startSection('title','ผลงานสร้างสรรค์'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/select2/select2.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ผลงานสร้างสรรค์</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
              </div>
            </div>


            <div id='showdetail'>
            <!-- form start -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $__env->yieldContent('subtitle'); ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
            <div id = 'msgname'></div>

            <form enctype="multipart/form-data" id="form_data" name="form_data" role="form" method="POST">
              <div class="form-group" id="j">
                <label>มหาวิทยาลัย</label>
                <?php if(Auth::user()->role->slug == 'Admin'): ?>
                <select name="university_id" id="university_id" class="form-control" style="width:350px">
                    <option value="">--- เลือกมหาวิทยาลัย ---</option>
                    <?php foreach($objuniver as $key => $value): ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php else: ?>
                <h5><?php echo e(Auth::user()->university->name); ?></h5>
                <input type="hidden" name="university_id" id="university_id" value="<?php echo e(Auth::user()->university_id); ?>">
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label>นักวิจัย(เจ้าของผลงานสร้างสรรค์)</label>
                <div class="displayresch">
                <?php if(Auth::user()->role->slug == 'Admin'): ?>
                <select name="researcher_id" id="researcher_id" class="form-control select2" style="width:350px">
                    <option value="">--- เลือกนักวิจัย ---</option>
                </select>
                <?php else: ?>
                <select name="researcher_id" id="researcher_id" class="form-control select2" style="width:350px">
                    <option value="">--- เลือกนักวิจัย ---</option>
                    <?php foreach($objresch as $key): ?>
                        <option value="<?php echo e($key->id); ?>"><?php echo e($key->headname); ?><?php echo e($key->firstname); ?> <?php echo e($key->lastname); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
                </div>
              </div>

                <div class="form-group">
                  <label>กลุ่มผลงานสร้างสรรค์</label>
                  <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกกลุ่มงานสร้างสรรค์ ---</option>
                      <?php foreach($objtag as $key => $value): ?>
                          <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                    <div id = 'taggroupdetail'></div>
                </div>
                <div class="form-group">
                  <label>สาขาวิชาการ</label>
                  <select name="isced_id" id="isced_id" class="form-control" style="width:350px">
                      <option value="">--- สาขาวิชาการ ---</option>
                      <option value="1000">การศึกษา</option>
                      <option value="2000">มนุษยศาสตร์และศิลปกรรมศาสตร์</option>
                      <option value="3000">สังคมศาสตร์ ธุรกิจ และกฎหมาย</option>
                      <option value="4000">วิทยาศาสตร์</option>
                      <option value="5000">วิศวกรรมศาสตร์ การผลิต และการก่อสร้าง</option>
                      <option value="6000">เกษตรศาสตร์</option>
                      <option value="7000">สุขภาพและสวัสดิการ</option>
                      <option value="8000">การบริการ</option>
                  </select>
                </div>

          <div class="form-group">
            <label>ข้อมูลผลงานสร้างสรรค์</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ชื่อผลงาน</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="ชื่อผลงานสร้างสรรค์ (บทความ องค์ความรู้ สิ่งประดิษฐ์ นวัตกรรม และอื่นๆ)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> คำสำคัญ</label></span>
                  <input type="text" class="form-control" name="keyword" id="keyword" placeholder="คำสำคัญ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> บทคัดย่อ</label></span>
                  <textarea class="form-control" id="abstract" name="abstract" placeholder="บทคัดย่อ" style="height:150px"></textarea>
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ไฟล์</label></span>
                  <input type="hidden"  id="fileold" name="fileold">
                  <input type="file" class="form-control" name="file" id="file">
                </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  (ไฟล์ประเภท pdf, docs, exls, ppts, jpg, png ขนาดไม่เกิน 20 MB)
                </p>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ผู้ร่วมดำเนินการ</label></span>
                  <input type="text" class="form-control" name="contribute" id="contribute" placeholder="ผู้ร่วมดำเนินการ">
                </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  (ผู้ร่วมวิจัยหลายคนให้คั่นด้วยเครื่องหมาย , )
                </p>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ปี พ.ศ.</label></span>
                  <input type="text" class="form-control" name="createyear" id="createyear" placeholder="ปี พ.ศ.(ที่ทำผลงานสร้างสรรค์)">
                </div>
                </div>
                <input type="hidden"  id="id" name="id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            </form>
          </div>
        </div>
      </div>
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
      $('.btnback').hide();
      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.btndetailexp').hide();

      //load center
      $('select[name="university_id"]').on('change', function() {
        var stateID = $(this).val();
        loadselect(stateID,'');
      });


      $('select[name="taggroup_id"]').on('change', function() {
        var id = $(this).val();
        $.ajax({
            url : '<?php echo url('user/tagdetail'); ?>',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>',
              'id' : id,
            },
            success : function(e)
            {
              $('#taggroupdetail').html(e);
            }
        });
      });

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#university_id').focus();
          $(".select2").select2();
          var university_id = $('#university_id').val();
          loadselect(university_id,'');

      });

      $('.btncancel').click(function(){
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
          $(".select2").select2();
      });

      displaydata();


      $('body').delegate('.edit','click',function(){
        //$('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#title').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '<?php echo url('user/creative'); ?>'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(e)
            {
              //alert(e.id);
              $('#id').val(e.id);
              $('#taggroup_id').val(e.taggroup_id);
              $('#isced_id').val(e.isced_id);
              $('#researcher_id').val(e.researcher_id);
              $('#title').val(e.title);
              $('#keyword').val(e.keyword);
              $('#abstract').val(e.abstract);
              $('#fileold').val(e.file);
              $('#contribute').val(e.contribute);
              $('#createyear').val(e.createyear);

              $('select[name="researcher_id"]').empty();
              $('select[name="researcher_id"]').html('<option value="'+e.researcher_id+'">'+e.headname+e.firstname+' '+e.lastname+'</option>');

              $('#university_id').val(e.university_id);

            }
        });

      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $.ajax({
            url : '<?php echo url('user/creative'); ?>'+'/'+id,
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
              displaydata();
              $('#ccreative' ).html(d.objs);
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
                }else if(err.status === 404 || err.status === 500){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                }else{
                  $( '#msgname' ).html( 'ERROR : '+err.status );
                }
            }
        });
      }
      });
  });


      $('.saverecord').click(function(){
        //alert('hell save');
              $.ajax({
                  url : '<?php echo url('user/creative'); ?>',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_data")[0]),

                  success:function(re)
                  {
                    //alert(re);
                    if(re.check){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }
                    //alert(1);
                    $('.btndetail').show();
                    $('#showdetail').hide();
                    $("#form_data")[0].reset();
                    $('#ccreative' ).html(re.objs);
                    $(".select2").select2();
                    //alert(2);
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
                      }else if(err.status === 404 || err.status === 500){
                        alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                      }else{
                        $( '#msgname' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;


    function displaydata(){
      //alert(0);
      $.ajax({
        url : '<?php echo url('user/creative/create'); ?>',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.displayrecord').html(s);
          //if(re == 0){alert('save');}else{alert('not save');}
          $("#example1").DataTable();
        }
      });
    }

    function loadselect(id,idresch){
          $.ajax({
              url : '<?php echo url('ajaxresch'); ?>'+'/'+id,
              type: "GET",
              success:function(s) {
                $('.displayresch').html(s);
                $('#researcher_id').val(idresch);
                $(".select2").select2();
              }
          });
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>