<?php $__env->startSection('title','สมาชิกระบบ'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">สมาชิกผู้ใช้ระบบ</h3>
    </div>
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">

  <div id="tri" class="btn-group btn-group-sm">
    <a href="<?php echo url('admin/member'); ?>" type="button" name="total" class="btn btn-default <?php echo e(classActiveOnlyPath('admin/member')); ?>">ทั้งหมด
      <span class="badge"><?php echo e($counts['total']); ?></span>
    </a>
    <?php foreach($roles as $role): ?>
      <a href="<?php echo url('admin/member/sort/' . $role->slug); ?>" type="button" name="<?php echo $role->slug; ?>" class="btn btn-default <?php echo e(classActiveOnlySegment(3, $role->slug)); ?>"><?php echo e($role->title); ?>

        <span class="badge"><?php echo e($counts[$role->slug]); ?></span>
      </a>
      <?php echo e(classActiveSegment(1,'users')); ?>

    <?php endforeach; ?>
  </div>

	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>ชื่อ</th>
					<th>สถานะ</th>
					<th>สังกัด</th>
					<th>อนุมัติ</th>
          <th></th>
          <th></th>
          <th></th>
				</tr>
			</thead>
			<tbody>
        <?php foreach($users as $user): ?>
      		<tr <?php echo !$user->seen? 'class="warning"' : ''; ?>>
      			<td class="text-primary"><strong><?php echo e($user->headname.$user->firstname.' '.$user->lastname); ?></strong></td>
      			<td><?php echo e($user->role->title); ?><?php echo $user->permit==2? '(ผู้บริหาร)' : ''; ?></td>
      			<td>
      				<?php echo $user->university_id? $user->university->name.'<br>' : ''; ?>

      				<?php echo $user->center_id? 'ศูนย์ : '.$user->center->name.'<br>' : ''; ?>

      				<?php echo $user->area_id? 'พื้นที่ : '.$user->area->name : ''; ?>

      			</td>
      			<td><?php echo Form::checkbox('seen', $user->id, $user->seen); ?></td>
      			<td>
      				<a href="<?php echo e(url("admin/member/".$user->id)); ?>" class="btn btn-success"> รายละเอียด </a>
      			</td>
      			<td>
              <a href="<?php echo e(url("admin/member/".$user->id."/edit")); ?>" class="btn btn-warning"> แก้ไข </a>
            </td>
      			<td>
      				<form action="<?php echo e(url('admin/member/'.$user->id)); ?>" method="post" onsubmit="return(confirm('ลบข้อมูล'))">
      					<?php echo e(method_field('DELETE')); ?>

      					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      					<button type="submit" class="btn btn-danger">ลบข้อมูล</button>
      				</form>
      			</td>
      		</tr>
      	<?php endforeach; ?>
      </tbody>
		</table>
	</div>
  <a href="<?php echo e(url("admin/member/create")); ?>" class="btn btn-primary pull-left"> เพิ่มสมาชิก </a>

	<div class="pull-right link"><?php echo $links; ?></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

  <script>

    $(function() {
      //var role_id = $('#role_txt_id').val();
      //$('#role_id').val(role_id);

      // Seen gestion
      $(document).on('change', ':checkbox', function() {
        $(this).parents('tr').toggleClass('warning');
        $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
        var token = $('input[name="_token"]').val();
        $.ajax({
          url: '<?php echo url('admin/member/userseen'); ?>' + '/' + this.value,
          type: 'PUT',
          data: "seen=" + this.checked + "&_token=" + token
        })
        .done(function() {
          $('.fa-spin').remove();
          $('input[type="checkbox"]:hidden').show();
        })
        .fail(function() {
          $('.fa-spin').remove();
          var chk = $('input[type="checkbox"]:hidden');
          chk.show().prop('checked', chk.is(':checked') ? null:'checked').parents('tr').toggleClass('warning');
          alert('<?php echo e('ล้มเหลว'); ?>');
        });
      });
    });

  </script>
  <?php
  session(['page' => $users->currentPage()]);
  ?>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>