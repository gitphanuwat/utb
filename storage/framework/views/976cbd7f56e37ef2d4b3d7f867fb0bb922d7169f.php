<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(asset("assets/bootstrap/css/bootstrap.min.css")); ?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset("assets/dist/css/AdminLTE.min.css")); ?>" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset("assets/dist/css/skins/_all-skins.min.css")); ?>" />

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.css")); ?>" />
  <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(url('/')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>rd</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Research</b>Lrd</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <?php if(Auth::user()): ?>
          <?php if(Auth::user()->role->slug == 'University'): ?>
            <?php echo e(Auth::user()->university->name); ?>

          <?php endif; ?>
          <?php if(Auth::user()->role->slug == 'Manager'): ?>
            <?php echo e(Auth::user()->center->name); ?>

          <?php endif; ?>
          <?php if(Auth::user()->role->slug == 'Operator'): ?>
            <?php echo e(Auth::user()->area->name); ?>

          <?php endif; ?>
        <?php endif; ?>
      </a>
      <div class="navbar-custom-menu">
        <?php echo $__env->make('layouts.dropmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $__env->yieldContent('title'); ?>
        <small><?php echo $__env->yieldContent('subtitle'); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $__env->yieldContent('title'); ?></a></li>
        <li class="active"><?php echo $__env->yieldContent('subtitle'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->yieldContent('body'); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(asset("assets/plugins/jQuery/jquery-2.2.3.min.js")); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset("assets/bootstrap/js/bootstrap.min.js")); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset("assets/plugins/slimScroll/jquery.slimscroll.min.js")); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset("assets/plugins/fastclick/fastclick.js")); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset("assets/dist/js/app.min.js")); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset("assets/dist/js/demo.js")); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
