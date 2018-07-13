
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <?php if(Auth::guest()): ?>
      <img src="<?php echo e(asset("/images/lrd_logo.png")); ?>"  alt="Local Research Development">
      <?php elseif(Auth::user()->picture): ?>
      <img src="<?php echo e(asset("/images/avatar/large")); ?>/<?php echo e(Auth::user()->picture); ?>" class="img-circle" alt="Local Research Development">
      <?php else: ?>
      <img src="<?php echo e(asset("/images/no_image.png")); ?>"  class="img-circle"  alt="Local Research Development">
      <?php endif; ?>
    </div>

    <?php if(Auth::guest()): ?>
    <div class="pull-left info">
      <p>UTB System</p>
      <a href="#">Uttaradit Book System.</a>
    </div>
    <?php else: ?>
    <div class="pull-left info">
    <p><?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></p>
    <a href="#"><i class="fa fa-circle text-success"></i> ระดับ : <?php echo e(Auth::user()->role->title); ?><?php echo Auth::user()->permit==2? '(ผู้บริหาร)' : ''; ?><br>

      <?php if(Auth::user()->role->slug == 'Organize'): ?>
        <?php echo e(Auth::user()->organize->name); ?>

      <?php endif; ?>

    </a>
    </div>
    <?php endif; ?>

  </div>

  <!-- search form -->
  <form action="<?php echo e(url('search')); ?>" method="POST" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search...">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
          <span class="input-group-btn">
            <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- sidebar menu: : style can be found in sidebar.less -->

<ul class="sidebar-menu">

<?php if(Auth::user()): ?>

        <li class="header">เมนู:ข้อมูลหน่วยงาน</li>
        <li <?php echo classActivePath('/'); ?>><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
          <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>

            <li <?php echo classActivePath('manager/areauser'); ?>><a href="<?php echo e(url ('manager/areauser')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'><?php echo e('99'); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('manager/expert'); ?>><a href="<?php echo e(url ('manager/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'><?php echo e('99'); ?></div></small>
              </span></a></li>

              <li <?php echo classActivePath('organize'); ?>><a href="<?php echo e(url('/managerset/organize')); ?>"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('community'); ?>><a href="<?php echo e(url('/managerset/village')); ?>"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('activity'); ?>><a href="<?php echo e(url('/managerset/activity')); ?>"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('group'); ?>><a href="<?php echo e(url('/managerset/group')); ?>"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('knowledge'); ?>><a href="<?php echo e(url('/managerset/knowledge')); ?>"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('travel'); ?>><a href="<?php echo e(url('/managerset/travel')); ?>"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('calendar'); ?>><a href="<?php echo e(url('/managerset/calendar')); ?>"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('poll'); ?>><a href="<?php echo e(url('/managerset/poll')); ?>"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('complaint'); ?>><a href="<?php echo e(url('/managerset/complaint')); ?>"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('problem'); ?>><a href="<?php echo e(url('/managerset/problem')); ?>"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('download'); ?>><a href="<?php echo e(url('/managerset/download')); ?>"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
              <li <?php echo classActivePath('user/infor'); ?>>
                <a href="<?php echo e(url ('user/infor')); ?>">
                  <i class="fa fa-weixin"></i> <span>ข่าวสาร&กิจกรรม</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-gray"><div id = 'cinfor'><?php echo e('88'); ?></div></small>
                  </span>
                </a>
              </li>
              <li <?php echo classActivePath('user/question'); ?>>
                <a href="<?php echo e(url ('user/question')); ?>">
                  <i class="fa fa-envelope"></i> <span>การสื่อสารกับนักวิจัย</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('88'); ?></div></small>
                  </span>
                </a>
              </li>
              <li><hr></li>
              <li <?php echo classActivePath('about'); ?>><a href="<?php echo e(url('about')); ?>"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
              <li <?php echo classActivePath('search'); ?>><a href="<?php echo e(url('search')); ?>"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
                  <!-- Authentication Links -->
<?php else: ?>
    <li class="header">เมนูหลัก</li>
    <li <?php echo classActivePath('/'); ?>><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('organize'); ?>><a href="<?php echo e(url('/organize')); ?>"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('community'); ?>><a href="<?php echo e(url('community')); ?>"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('activity'); ?>><a href="<?php echo e(url('activity')); ?>"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('group'); ?>><a href="<?php echo e(url('group')); ?>"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('knowledge'); ?>><a href="<?php echo e(url('knowledge')); ?>"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('travel'); ?>><a href="<?php echo e(url('travel')); ?>"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('calendar'); ?>><a href="<?php echo e(url('calendar')); ?>"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('poll'); ?>><a href="<?php echo e(url('poll')); ?>"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('complaint'); ?>><a href="<?php echo e(url('complaint')); ?>"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('problem'); ?>><a href="<?php echo e(url('problem')); ?>"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('download'); ?>><a href="<?php echo e(url('download')); ?>"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small></span></a></li>
    <li <?php echo classActivePath('about'); ?>><a href="<?php echo e(url('about')); ?>"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
    <li><hr></li>
    <li <?php echo classActivePath('search'); ?>><a href="<?php echo e(url('search')); ?>"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
    <li <?php echo classActivePath('register'); ?>><a href="<?php echo e(url('register')); ?>"><i class="fa fa-user"></i> <span>สมัครสมาชิก</span></a></li>
<?php endif; ?>

<!-- Authentication Links -->
<?php if(Auth::guest()): ?>
    <li <?php echo classActivePath('login'); ?>><a href="<?php echo e(url('login')); ?>"><i class="fa fa-lock"></i> <span>เข้าสู่ระบบ</span></a></li>
<?php else: ?>
    <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
<?php endif; ?>

  </ul>
</section>
