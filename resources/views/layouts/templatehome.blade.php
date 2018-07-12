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
  <link rel="stylesheet" href="{{ asset("assets/plugins/datatables/dataTables.bootstrap.css") }}" />
  <link rel="icon" href="{!! asset('images/lrd_logo.ico') !!}"/>

  @yield('styles')


</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->

    <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
<img src="dist/img/logo.png"  width="30" />
								Socialbook
            </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>



      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-home"></i>
              <span class="label label-success">5</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 5 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/guest.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 11 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-users"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 5 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 11 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">ลงทะเบียน</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/guest.jpg" class="img-circle" alt="User Image">

                <p>
                  Guest - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <span>Login</span>
            </a>
          </li>


          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>





  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/guest.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>ศูนย์ข้อมูลชุมชน</p>
          <a href="#"><i class="fa fa-circle text-success"></i> ผู้ใช้ทั่วไป</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">เมนูสำหรับสมาชิกระบบ</li>
        <li class="active">
          <a href="index.php"><i class="fa fa-dashboard"></i> ข้อมูลข่าวสาร
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">12</small>
            </span>
          </a>
        </li>
        <li>
          <a href="organize.php"><i class="fa fa-home"></i> ข้อมูลหน่วยงาน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">5</small>
            </span>
          </a>
        </li>
        <li>
          <a href="community.php"><i class="fa fa-users"></i> ข้อมูลชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">8</small>
            </span>
          </a>
        </li>
        <li>
          <a href="activity.php"><i class="fa fa-flag"></i> กิจกรรมเด่นชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">15</small>
            </span>
          </a>
        </li>
        <li>
          <a href="group.php"><i class="fa fa-tags"></i> การรวมกลุ่มชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">5</small>
            </span>
          </a>
        </li>
        <li>
          <a href="knowledge.php"><i class="fa fa-wechat"></i> แลกเปลี่ยนเรียนรู้
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">3</small>
            </span>
          </a>
        </li>
        <li>
          <a href="travel.php"><i class="fa fa-image"></i> แหล่งท่องเที่ยว
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">6</small>
            </span>
          </a>
        </li>
        <li>
          <a href="calendar.php"><i class="fa fa-calendar"></i> ปฏิทินกิจกรรมชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">15</small>
            </span>
          </a>
        </li>
        <li>
          <a href="poll.php"><i class="fa fa-server"></i> สำรวจความคิดเห็น
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">4</small>
            </span>
          </a>
        </li>
        <li>
          <a href="complaint.php"><i class="fa fa-legal"></i> เรื่องร้องเรียน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">3</small>
            </span>
          </a>
        </li>
        <li>
          <a href="problem.php"><i class="fa fa-question"></i> ปัญหาชุมชน
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">3</small>
            </span>
          </a>
        </li>
        <li>
          <a href="download.php"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร
            <span class="pull-right-container">
              <small class="label pull-right bg-gray">5</small>
            </span>
          </a>
        </li>
        <li><hr></li>
        <li><a href="search.php"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
        <li><a href="login.php"><i class="fa fa-lock"></i> <span>Logout</span></a></li>
      </ul>

      <ul class="sidebar-menu">
        <li class="header">เมนูหลัก</li>
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> ศูนย์ข้อมูลข่าวสาร</a></li>
        <li><a href="organize.php"><i class="fa fa-home"></i> ข้อมูลหน่วยงาน</a></li>
        <li><a href="community.php"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span></a></li>
        <li><a href="activity.php"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span></a></li>
        <li><a href="group.php"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span></a></li>
        <li><a href="knowledge.php"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span></a></li>
        <li><a href="travel.php"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span></a></li>
        <li><a href="calendar.php"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span></a></li>
        <li><a href="poll.php"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span></a></li>
        <li><a href="complaint.php"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span></a></li>
        <li><a href="problem.php"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span></a></li>
        <li><a href="download.php"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร</a></li>
        <li><a href="about.php"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
        <li><hr></li>
        <li><a href="search.php"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
        <li><a href="register.php"><i class="fa fa-user"></i> <span>สมัครสมาชิก</span></a></li>
        <li><a href="login.php"><i class="fa fa-lock"></i> <span>เข้าสู่ระบบ</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ศูนย์ข้อมูลชุมชน
        <small>เครือข่ายจังหวัดอุตรดิตถ์</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
        <li class="active">ระบบสารสนเทศ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>35</h3>

              <p>หน่วยงาน</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>42</h3>

              <p>ชุมชน</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>33</h3>

              <p>สมาชิก</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>กิจกรรม</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">กิจกรรมชุมชน</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>

            <div class="box-body chat">

              <div class="item">
                <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                    อดุลย์ ศรีสืบวงษ์
                  </a>
                #สืบสานประเพณี อบต.แม่พูลจัดงานประเพณีรดน้ำดำหัวผู้สูงอายุแสดงออกถึงความเคารพความกตัญญูกตเวทีต่อผู้สูงอายุ"ขอบคุณนายกฯที่มีรางวัลพิเศษ"มาให้ผู้สูงอายุ
                </p>
                <div class="attachment">
                  <h4>Attachments:</h4>

                  <p class="filename">
                    <img src="dist/img/p1.png">
                  </p>
                  <p class="message">
                    <img src="dist/img/cm1.png">
                  </p>

                </div>
                <!-- /.attachment -->

              </div>


              <!-- /.item -->
              <!-- chat item -->
              <div class="item">
                <img src="dist/img/user3-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                    อบต.ขุนฝาง
                  </a>
                  ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลขุนฝาง พาเด็กๆศึกษาแหล่งเรียนรู้ภายในตำบลขุนฝาง วันที่ 2 กุมภาพันธ์ 2560 เวลา 09.00.น. ณ ขุนฝางบ้านกังหัน, ขุนฝางบ้านสวนฮารีน,ขุนฝางสวนม้าโฮมเสตย์
                </p>
                <div class="attachment">
                  <p class="filename">
                    <img src="dist/img/c2.png">
                  </p>

                </div>

              </div>
              <!-- /.item -->
              <!-- chat item -->
              <div class="item">
                <img src="dist/img/user6-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 1:15</small>
                    อบต.ไร่อ้อย
                  </a>
                  พิธีเปิดศูนย์การเรียนรู้เศรษกิจพอเพียง ต.ไร่อ้อย — ที่ อบต.ไร่อ้อย
                </p>
                <div class="attachment">
                  <p class="filename">
                    <img src="dist/img/c3.png">
                  </p>

                </div>

              </div>

            <!-- /.chat -->
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message...">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List -->

          <!-- /.box -->

          <!-- quick email widget -->


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-4 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                หน่วยงาน
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map5" style="height: 250px; width: 100%;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d486258.629774377!2d100.48741157093338!3d17.796605605247326!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1497232249821" width="270" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">สถิติการเยี่ยมชม</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">กิจกรรมชุมชน</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">อบต.น้ำพี้</span>
                  </div>
                  <div>
                    <a href="#">กิจกรรมบุญบั้งไฟ หมู่บ้าน..</a>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">อบต.บ่อทอง</span>
                  </div>
                  <div>
                    <a href="#">ตักบาทเทโววัดบ่อทอง..</a>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">อบต.ท่าสัก</span>
                  </div>
                  <div>
                    <a href="#">ประเพณีแห่นางแมว..</a>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">อบต.ชัยจุมพล</span>
                  </div>
                  <div>
                    <a href="#">แห่เทียนเข้าพรรษา..</a>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">แจ้งปัญหาชุมชน</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="ผู้ส่ง">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="หัวเรื่อง">
                </div>
                <div>
                  <textarea class="textarea" placeholder="ข้อความ" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">ส่งข้อมูล
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">สำรวจความคิดเห็น</h3>
              <p>
              ท่านต้องการให้ชุมชนพัฒนาและแก้ไขปัญหาในด้านใดโดยเร็วมากที่สุด
            </p>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label>
                  <input type="radio" name="r1" class="minimal" checked>
                  ระบบประปาประจำหมู่บ้าน
                </label><br>
                <label>
                  <input type="radio" name="r1" class="minimal">
                  ระบบเส้นทางสัญจรภายในชุมชน
                </label><br>
                <label>
                  <input type="radio" name="r1" class="minimal">
                  ระบบเสียงตามสาย
                </label>
                <button type="button" class="pull-right btn btn-default" id="sendEmail">ส่งข้อมูล
                  <i class="fa fa-arrow-circle-right"></i></button>

              </div>
            </div>
          </div>












        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>About</b> Us
    </div>
    <strong>Copyright &copy; 2017 <a href="http://www.socialbook.co.th">Socialbook.com</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
