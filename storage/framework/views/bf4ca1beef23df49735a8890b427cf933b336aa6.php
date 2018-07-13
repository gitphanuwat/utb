<div class="row">
    <?php if(1): ?>
        <div class="col-sm-6">
            <?php if(Auth::user()->picture): ?>
                <img src="<?php echo e(asset('images/avatar/large/' . Auth::user()->picture)); ?>"
                     class="col-xs-12"/>
            <?php else: ?>
                <img src="<?php echo e(asset('images/no_image.png')); ?>" class="col-xs-12"/>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="col-sm-6">
        <p><strong>username: </strong><?php echo e(Auth::user()->firstname); ?></p>

        <p><strong>email: </strong><?php echo e(Auth::user()->email); ?></p>

        <p><strong>registered_at
                : </strong><?php echo e(date('d M Y - H:i:s', strtotime(Auth::user()->created_at))); ?></p>

        <p><strong>updated_at
                : </strong><?php echo e(date('d M Y - H:i:s', strtotime(Auth::user()->updated_at))); ?></p>

    </div>
</div>
<br/>
