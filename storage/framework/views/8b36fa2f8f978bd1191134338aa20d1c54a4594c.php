<?php if(Session::has('flash_notification.message')): ?>
<?php if(Session::has('flash_notification.overlay')): ?>
<?php echo $__env->make('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
<div class="alert alert-<?php echo e(Session::get('flash_notification.level')); ?>">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php if(Session::get('flash_notification.level') == 'info'): ?>
    <i class='glyphicon glyphicon-info-sign'></i>
    <?php elseif(Session::get('flash_notification.level') == 'success'): ?>
    <i class="glyphicon glyphicon-ok-sign"></i>
    <?php elseif(Session::get('flash_notification.level') == 'warning'): ?>
    <i class="glyphicon glyphicon-warning-sign"></i>
    <?php elseif(Session::get('flash_notification.level') == 'danger'): ?>
    <i class="glyphicon glyphicon-remove-sign"></i>
    <?php endif; ?>
    <?php echo e(Session::get('flash_notification.message')); ?>


    <?php if($errors): ?>
    <ul>
        <?php foreach($errors as $error): ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php endif; ?>

<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="glyphicon glyphicon-remove-sign"></i> <?php echo e(trans('พบข้อผิดพลาด')); ?>

    <ul>
        <?php foreach($errors->all() as $error): ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
