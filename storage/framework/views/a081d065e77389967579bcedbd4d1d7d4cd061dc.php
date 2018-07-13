<?php $__env->startSection('title','สมาชิกผู้ใช้ระบบ'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">สมาชิกผู้ใช้ระบบ :<?php echo e(Auth::user()->university->name); ?> </h3>
    </div>
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">

<form role="form" action="<?php echo e($url); ?>" method="POST">
  <?php echo e(method_field($method)); ?>

    <div class="form-group">
      <label>สิทธิ์การใช้งานระบบ</label>
      <select name="role_id" id="role_id" class="form-control" style="width:350px">
          <option value="">--- เลือกสิทธิ์สมาชิก ---</option>
          <option value="2">มหาวิทยาลัย</option>
          <option value="3">ศูนย์จัดการเครือข่าย</option>
          <option value="4">พื้นที่ชุมชน</option>
      </select>

      <div class="displayrole">
      </div>

      <input type="hidden" name="role_txt_id" id="role_txt_id" value="<?php echo e(isset($obj->role_id) ? $obj->role_id : ''); ?>">
      <input type="hidden" name="university_id" id="university_txt_id" value="<?php echo e(isset($obj->university_id) ? $obj->university_id : ''); ?>">
      <input type="hidden" name="center_txt_id" id="center_txt_id" value="<?php echo e(isset($obj->center_id) ? $obj->center_id : ''); ?>">
      <input type="hidden" name="area_txt_id" id="area_txt_id" value="<?php echo e(isset($obj->area_id) ? $obj->area_id : ''); ?>">
      <input type="hidden" name="txt_permit" id="txt_permit" value="<?php echo e(isset($obj->permit) ? $obj->permit : ''); ?>">
    </div>
    <div class="form-group">
    <label>ข้อมูลผู้ใช้ระบบ</label>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
      <input type="text" class="form-control" name="headname" id="headname" placeholder="คำนำหน้าชื่อ" value="<?php echo e(isset($obj->headname) ? $obj->headname : ''); ?>">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ" value="<?php echo e(isset($obj->firstname) ? $obj->firstname : ''); ?>">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="สกุล" value="<?php echo e(isset($obj->lastname) ? $obj->lastname : ''); ?>">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> ที่อยู่</label></span>
      <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่" value="<?php echo e(isset($obj->address) ? $obj->address : ''); ?>">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
      <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร" value="<?php echo e(isset($obj->tel) ? $obj->tel : ''); ?>">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> เฟสบุ๊ค</label></span>
      <input type="text" class="form-control" name="facebook" id="facebook" placeholder="เฟสบุ๊ค" value="<?php echo e(isset($obj->facebook) ? $obj->facebook : ''); ?>">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
      <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์" value="<?php echo e(isset($obj->email) ? $obj->email : ''); ?>">
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><label style="width:100px"> รหัสผ่าน</label></span>
      <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" value="<?php echo e(isset($obj->password) ? $obj->password : ''); ?>">
    </div>
    </div>
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <button type="submit"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
    <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
</form>

</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script>

$(function() {
      var role_id = $('#role_txt_id').val();
      var center_id = $('#center_txt_id').val();
      var area_id = $('#area_txt_id').val();
      displayroleall(role_id);
      //load role
      $('select[name="role_id"]').on('change', function() {
        var roleID = $(this).val();
        displayrole(roleID);
      });

      $('.btncancel').click(function(){
          window.location.replace("<?php echo e(url('univer/member')); ?>");
      });


});

function displayroleall(roleID){
  //alert(0);
  var center_id = $('#center_txt_id').val();

  var role_id = $('#role_txt_id').val();
  var center_id = $('#center_txt_id').val();
  var area_id = $('#area_txt_id').val();
  var permit = $('#txt_permit').val();

  $.ajax({
    url : '<?php echo url('ajaxroleuni'); ?>'+'/'+roleID,
    type : "get",
    //asyncfalse
    data : {
      '_token': '<?php echo e(csrf_token()); ?>',
      'center_id' : center_id,
    },
    success : function(s)
    {
      $('.displayrole').html(s);
      if (role_id){$('#role_id').val(role_id);}
      if (center_id){$('#center_id').val(center_id)};
      if (area_id){$('#area_id').val(area_id)};
      if(permit==2){document.getElementById("permit").checked = true;}
      $('select[name="center_id"]').on('change', function() {
        var stateID = $(this).val();
        loadarea(stateID,'');
      });
    }
  });
}
    function displayrole(roleID){
      //alert(0);
      var center_id = $('#center_txt_id').val();
      $.ajax({
        url : '<?php echo url('ajaxroleuni'); ?>'+'/'+roleID,
        type : "get",
        //asyncfalse
        data : {
          '_token': '<?php echo e(csrf_token()); ?>',
          'center_id' : center_id,
        },
        success : function(s)
        {
          $('.displayrole').html(s);
          $('select[name="center_id"]').on('change', function() {
            var stateID = $(this).val();
            loadarea(stateID,'');
          });
        }
      });
    }

    function loadselect(id,idcen){
          $.ajax({
              url : '<?php echo url('ajax'); ?>'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                //alert("TEST");
                  $('select[name="center_id"]').empty();
                  $('select[name="center_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
              }
          });
    }

    function loadarea(id,idcen){
          $.ajax({
              url : '<?php echo url('ajaxarea'); ?>'+'/'+id,
              type: "GET",
              dataType: "json",
              success:function(data) {
                  $('select[name="area_id"]').empty();
                  $('select[name="area_id"]').html('<option value="">-- เลือกพื้นที่ชุมชน --</option>');
                  $.each(data, function(key, value) {
                      $('select[name="area_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
              }
          });
    }


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>