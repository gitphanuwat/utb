<?php if(Auth::user()): ?>
<ul class="nav navbar-nav">
  <!-- User Account: style can be found in dropdown.less -->
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <?php if(Auth::user()->picture): ?>
      <img src="<?php echo e(asset('/images/avatar/large')); ?>/<?php echo e(Auth::user()->picture); ?>" class="img-circle" style="width:20px">
      <?php else: ?>
      <img src="<?php echo e(asset('/images/no_image.png')); ?>"  class="img-circle" style="width:20px">
      <?php endif; ?>
      <span class="hidden-xs"><?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></span>
    </a>
    <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
        <?php if(Auth::user()->picture): ?>
        <img src="<?php echo e(asset("/images/avatar/large")); ?>/<?php echo e(Auth::user()->picture); ?>" class="img-circle" alt="Local Research Development">
        <?php else: ?>
        <img src="<?php echo e(asset("/images/no_image.png")); ?>"  class="img-circle" alt="Local Research Development">
        <?php endif; ?>
        <p>
          <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>

          <small>Member since <?php echo e(Auth::user()->created_at); ?></small>
        </p>
      </li>

      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="<?php echo e(url('profile/show')); ?>" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
          <a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat">Sign out</a>
        </div>
      </li>
    </ul>
  </li>
</ul>
<?php else: ?>
<ul class="nav navbar-nav">
  <!-- User Account: style can be found in dropdown.less -->
  <li class="pull-right">
    <a href="<?php echo e(url('/login')); ?>">
      <span class="hidden-xs"><i class="fa fa-user"></i> Member Login..</span>
    </a>
  </li>
</ul>
<?php endif; ?>
