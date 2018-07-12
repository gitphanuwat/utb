<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("assets/dist/css/AdminLTE.min.css") }}" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset("assets/dist/css/skins/_all-skins.min.css") }}" />

  @yield('styles')
  <link rel="icon" href="{!! asset('images/lrd_logo.ico') !!}"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/')}}" class="logo">
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
        @if(Auth::user())
          @if (Auth::user()->role->slug == 'University')
            {{ Auth::user()->university->name }}
          @endif
          @if (Auth::user()->role->slug == 'Manager')
            {{ Auth::user()->center->name }}
          @endif
          @if (Auth::user()->role->slug == 'Operator')
            {{ Auth::user()->area->name }}
          @endif
        @endif
      </a>
      <div class="navbar-custom-menu">
        @include('layouts.dropmenu')
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="treeview {{ classActiveOnlySegment(1,'univer') }}">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>ตั้งค่าระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li {!! classActivePath('univer/center') !!}><a href="{{ url ('univer/center') }}"><i class="fa fa-circle-o"></i> ศูนย์จัดการเครือข่าย
            <span class="pull-right-container">
              <small class="label pull-right bg-gray"><div id = 'ccenter'></div></small>
            </span></a></li>
          <li {!! classActivePath('univer/area') !!}><a href="{{ url ('univer/area') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray"><div id = 'careas'</div></small>
            </span></a></li>
          <li {!! classActivePath('univer/member') !!}><a href="{{ url ('univer/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
            <span class="pull-right-container">
              <small class="label pull-right bg-gray"><div id = 'cuser'></div></small>
            </span></a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
        <small>@yield('subtitle')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">@yield('title')</a></li>
        <li class="active">@yield('subtitle')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @include('flash::message')
      @yield('body')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset("assets/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset("assets/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("assets/plugins/fastclick/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("assets/dist/js/app.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("assets/dist/js/demo.js") }}"></script>
<!-- AdminLTE for demo purposes -->
@yield('script')
</body>
</html>
