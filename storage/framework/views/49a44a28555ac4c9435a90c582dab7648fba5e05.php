<?php $__env->startSection('title','นักวิจัย'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php
if(Auth::user()){include ('makejson.php');}
?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">นักวิจัย</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
              </div>
              <!-- /.box-body -->

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

            <form role="form" id="form_data" name="form_data">
                <div class="form-group">
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

          <div class="form-group" id="j">
            <label>ข้อมูลนักวิจัย</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
                  <input type="text" class="form-control" name="headname" id="headname" placeholder="คำนำหน้าชื่อ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
                  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="สกุล">
                </div>
                </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" > <label style="width:100px"> ที่อยู่</label></span>
            <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
            <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
            <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์">
          </div>
          </div>
                <input type="hidden"  id="id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
            </form>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="box-body">

          <div class="displayexpert"></div>
          <button type='button' class='btn btn-primary btndetailexp'><i class='fa fa-fw fa-plus'></i> เพิ่มข้อมูล</button>

          <div class="showdetailexp">
            <div class="box-body">
            <div id = 'msgnameexp'></div>
            <form role="form" id="form_dataexp" name="form_dataexp">
              <div class="form-group">
                <label>กลุ่มความเชี่ยวชาญ</label>
                <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                    <option value="">--- เลือกกลุ่มความเชี่ยวชาญ ---</option>
                    <?php foreach($objtag as $key => $value): ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                  <div id = 'taggroupdetail'></div>
              </div>
              <div class="form-group">
                <label>สาขาความเชี่ยวชาญ</label>
                <select name="isced_id" id="isced_id" class="form-control" style="width:350px">
                    <option value="">--- สาขาความเชี่ยวชาญ ---</option>
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
            <label>ข้อมูลความเชี่ยวชาญ</label>
            </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ความเชี่ยวชาญ(TH)</label></span>
                  <input type="text" class="form-control" name="title_th" id="title_th" placeholder="ความเชี่ยวชาญ (ภาษาไทย)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ความเชี่ยวชาญ(EN)</label></span>
                  <input type="text" class="form-control" name="title_eng" id="title_eng" placeholder="ความเชี่ยวชาญ (ภาษาอังกฤษ)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea class="form-control" id="detail" name="detail" placeholder="รายละเอียด"></textarea>
                </div>
                </div>

                <input type="hidden"  id="idexp">
                <input type="hidden"  id="researcher_id">
                <button type="button"  class="btn btn-primary saverecordexp">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecordexp">อัพเดทข้อมูล</button>
                <button type="button" class="btn btn-danger btncancelexp">ยกเลิก</button>
            </form>
            </div>

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
      $('.updaterecord').hide();
      $('.btnback').hide();
      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.btndetailexp').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#university_id').focus();
      });

      $('.btncancel').click(function(){
          $('.updaterecord').hide();
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
      });
      $('.btncancelexp').click(function(){
          $('.updaterecordexp').hide();
          $('.saverecordexp').show();
          $('.btndetailexp').show();
          $('.showdetailexp').hide();
          $('#msgnameexp').html('');
          //$("#form_dataexp")[0].reset();
          $('#taggroup_id').val('');
          $('#isced_id').val('');
          $('#title_th').val('');
          $('#title_eng').val('');
          $('#detail').val('');

      });
      $('.btnback').click(function(){
          $('#msgname').html('');
          $('#msgnameexp').html('');
          $('.displayexpert').hide();
          $('.displayrecord').show();
          $('.btndetail').show();
          $('.btnback').hide();
          $('.showdetailexp').hide();
          $('.btndetailexp').hide();
      });

      displaydata();

      $('body').delegate('.btndetailexp','click',function(){
        $('.showdetailexp').show();
        $('.updaterecordexp').hide();
        $('.btndetailexp').hide();
        $('#taggroupdetail').html('');
      });

      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#name').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '<?php echo url('user/researcher'); ?>'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(e)
            {
              $('#id').val(e.id);
              $('#university_id').val(e.university_id);
              $('#headname').val(e.headname);
              $('#firstname').val(e.firstname);
              $('#lastname').val(e.lastname);
              $('#address').val(e.address);
              $('#tel').val(e.tel);
              $('#email').val(e.email);
            },
            error : function(err){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
             }
        });

      });

      $('body').delegate('.editexp','click',function(){
        $('.updaterecordexp').show();
        $('.saverecordexp').hide();
        $('.showdetailexp').show();
        $('.btndetailexp').hide();
        $('#msgnameexp').html('');
        $('#title_th').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '<?php echo url('user/expertlist'); ?>'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(e)
            {
              //console.log(e.id);
              //alert(e.researcher_id);
              $('#idexp').val(e.id);
              $('#researcher_id').val(e.researcher_id);
              $('#taggroup_id').val(e.taggroup_id);
              $('#isced_id').val(e.isced_id);
              $('#title_th').val(e.title_th);
              $('#title_eng').val(e.title_eng);
              $('#detail').val(e.detail);
            }
        });

      });

      $('select[name="taggroup_id"]').on('change', function() {
        var id = $(this).val();
        //alert(id);
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

      $('body').delegate('.upexpert','click',function(){
        $('#showdetail').hide();
        $('.displayrecord').hide();
        $('.btndetail').hide();
        $('.btndetailexp').show();
        $('.displayexpert').show();
        $('.btnback').show();

        var id = $(this).data('id');
        displayexp(id);

      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.updaterecord').hide();
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $.ajax({
            url : '<?php echo url('user/researcher'); ?>'+'/'+id,
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
              $( '#cresearcher' ).html(d.objs);
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

      $('body').delegate('.deleteexp','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        var researcher_id = $('#researcher_id').val();
        $('.updaterecordexp').hide();
        $('.saverecordexp').show();
        $('#showdetailexp').hide();
        $('.btndetailexp').show();
        $.ajax({
            url : '<?php echo url('user/expertlist'); ?>'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '<?php echo e(csrf_token()); ?>'
            },
            success : function(d)
            {
              //alert(d);
              $("#form_dataexp")[0].reset();
              displaydata();
              displayexp(researcher_id);
              $('#researcher_id').val(researcher_id);
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
          var university_id = $('#university_id').val();
          var headname = $('#headname').val();
          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var address = $('#address').val();
          var tel = $('#tel').val();
          var email = $('#email').val();
          //$('#new_group').val('error');
              //alert(0);
              $.ajax({
                  url : '<?php echo url('user/researcher'); ?>',
                  type : "POST",
                  data : {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'university_id' : university_id,
                    'headname' : headname,
                    'firstname' : firstname,
                    'lastname' : lastname,
                    'address' : address,
                    'tel' : tel,
                    'email' : email,
                  },
                  success:function(re)
                  {
                    //alert(re.objs);
                    if(re.check){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      alert('เกิดข้อผิดพลาด');
                      //$( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $("#form_data")[0].reset();
                    $('#headname').focus();
                    $( '#cresearcher' ).html(re.objs);
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

      $('.saverecordexp').click(function(){
          //var expert_id = $('#expert_id').val();
          var researcher_id = $('#researcher_id').val();
          var taggroup_id = $('#taggroup_id').val();
          var isced_id = $('#isced_id').val();
          var title_th = $('#title_th').val();
          var title_eng = $('#title_eng').val();
          var detail = $('#detail').val();
          //$('#new_group').val('error');
              //alert(researcher_id);
              $.ajax({
                  url : '<?php echo url('user/expertlist'); ?>',
                  type : "POST",
                  ////asyncfalse
                  //dataType : 'json',
                  data : {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    //'expert_id' : 0,
                    'researcher_id' : researcher_id,
                    'taggroup_id' : taggroup_id,
                    'isced_id' : isced_id,
                    'title_th' : title_th,
                    'title_eng' : title_eng,
                    'detail' : detail,
                  },
                  success:function(re)
                  {
                    //alert(re);
                    if(re == 0){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      displayexp(researcher_id);
                      //flash()->success('Save OK.');
                      $( '#msgnameexp' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }

                    $("#form_dataexp")[0].reset();
                    $('#taggroup_id').focus();
                    $('#researcher_id').val(researcher_id);
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
                        $( '#msgnameexp' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                      }else{
                        $( '#msgnameexp' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;

    $('.updaterecord').click(function(){
      //alert(0);
      var id = $('#id').val();
      var university_id = $('#university_id').val();
      var headname = $('#headname').val();
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var address = $('#address').val();
      var tel = $('#tel').val();
      var email = $('#email').val();
            //alert(0);
            $.ajax({
              url : '<?php echo url('user/researcher'); ?>'+'/'+id,
              type : "POST",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '<?php echo e(csrf_token()); ?>',
                  'university_id' : university_id,
                  'headname' : headname,
                  'firstname' : firstname,
                  'lastname' : lastname,
                  'address' : address,
                  'tel' : tel,
                  'email' : email,
                },
                success : function(re)
                {
                  if(re == 0){
                    $( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  }
                  displaydata();
                  $('.updaterecord').hide();
                  $('.saverecord').show();
                  //$('#showdetail').hide();
                  //$('.btndetail').show();
                  $("#form_data")[0].reset();
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
    $('.updaterecordexp').click(function(){
      //alert(0);
      var id = $('#idexp').val();
      var researcher_id = $('#researcher_id').val();
      var taggroup_id = $('#taggroup_id').val();
      var isced_id = $('#isced_id').val();
      var title_th = $('#title_th').val();
      var title_eng = $('#title_eng').val();
      var detail = $('#detail').val();
            //alert(id);
            $.ajax({
              url : '<?php echo url('user/expertlist'); ?>'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '<?php echo e(csrf_token()); ?>',
                  'expert_id' : 0,
                  'researcher_id' : researcher_id,
                  'taggroup_id' : taggroup_id,
                  'isced_id' : isced_id,
                  'title_th' : title_th,
                  'title_eng' : title_eng,
                  'detail' : detail,
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('แก้ไขข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  displayexp(researcher_id);
                  $('.updaterecordexp').hide();
                  $('.saverecordexp').show();
                  $('#showdetailexp').hide();
                  $('.btndetailexp').hide();
                  $("#form_dataexp")[0].reset();
                  $('#researcher_id').val(researcher_id);
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
                      $( '#msgnameexp' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else if(err.status === 404 || err.status === 500){
                      alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                    }else{
                      $( '#msgnameexp' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
    }) ;

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '<?php echo url('user/researcher/create'); ?>',
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

    function displayexp(id){
      //alert(id);
        $.ajax({
          url : '<?php echo url('user/expertlist/create'); ?>',
          type : "get",
          //asyncfalse
          data : {
            'id' : id,
          },
          success : function(s)
          {
            $('#researcher_id').val(id);
            $('.displayexpert').html(s);
            $('#taggroupdetail').html('');
          }
        });
  }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>