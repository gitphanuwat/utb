<?php
use App\Taggroup;
use App\University;
use App\Center;
use App\User;

use App\Researcher;
use App\Expert;
use App\Research;
use App\Creative;
use App\Area;
use App\Useful;
use App\Infor;
use App\Question;


if(Auth::user()){
  if (Auth::user()->role->slug == 'Operator'){
    $ida = Auth::user()->area_id;
    $cobjuser = User::where('area_id',$ida)->get();
    $cobjexpert = Expert::where('area_id',$ida)->get();
    $cobjarea = Area::where('id',$ida)->get();
  }elseif(Auth::user()->role->slug == 'Manager'){
    $idc = Auth::user()->center_id;
    $idu = Auth::user()->university_id;
    $cobjarea = Area::where('center_id',$idc)->get();
    $cobjuser = User::where('center_id',$idc)->get();
    $cobjexpert = Expert::where('center_id',$idc)->get();
  }elseif(Auth::user()->role->slug == 'University'){
    $idu = Auth::user()->university_id;
    $cobjcenter = Center::where('university_id',$idu)->get();
    $cobjarea = Area::where('university_id',$idu)->get();
    $cobjuser = User::where('university_id',$idu)->get();
    $cobjresearcher = Researcher::where('university_id',$idu)->get();
    $cobjexpert = Expert::where('university_id',$idu)->get();
    $cobjresearch = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
    ->select('researchs.*')
    ->where('researchers.university_id',$idu)
    ->get();
    $cobjcreative = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
    ->select('creatives.*')
    ->where('researchers.university_id',$idu)
    ->get();
    $cobjuseful = Useful::leftJoin('users','usefuls.user_id','=','users.id')
    ->select('usefuls.*')
    ->where('users.university_id','=',$idu)
    ->get();
  }elseif(Auth::user()->role->slug == 'Admin'){

    $cobjgroup = Taggroup::get();
    $cobjuniver = University::get();
    $cobjcenter = Center::get();
    $cobjuser = User::get();

    $cobjarea = Area::get();

    $cobjresearcher = Researcher::get();
    $cobjexpert = Expert::get();
    $cobjresearch = Research::get();
    $cobjcreative = Creative::get();
    $cobjuseful = Useful::get();
  }

  $cobjinfor = Infor::get();
  $cobjquestion = Question::get();
}

?>

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
      <?php if(Auth::user()->role->slug == 'University'): ?>
        <?php echo e(Auth::user()->university->name); ?>

      <?php endif; ?>
      <?php if(Auth::user()->role->slug == 'Manager'): ?>
        <?php echo e(Auth::user()->center->name); ?>

      <?php endif; ?>
      <?php if(Auth::user()->role->slug == 'Operator'): ?>
        <?php echo e(Auth::user()->area->name); ?>

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
    <li class="header">เมนู:บริหารข้อมูล</li>
      <?php if(Auth::user()->role->slug == 'Admin'): ?>
      <li class="treeview <?php echo e(classActiveOnlySegment(1,'admin')); ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li <?php echo classActivePath('admin/group'); ?>><a href="<?php echo e(url ('admin/group')); ?>"><i class="fa fa-circle-o"></i> กลุ่มปัญหาวิจัย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cgroup'><?php echo e($cobjgroup->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('admin/university'); ?>><a href="<?php echo e(url ('admin/university')); ?>"><i class="fa fa-circle-o"></i> มหาวิทยาลัย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuniver'><?php echo e($cobjuniver->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('admin/center'); ?>><a href="<?php echo e(url ('admin/center')); ?>"><i class="fa fa-circle-o"></i> ศูนย์จัดการเครือข่าย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'ccenter'><?php echo e($cobjcenter->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('admin/area'); ?>><a href="<?php echo e(url ('admin/area')); ?>"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'><?php echo e($cobjarea->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('admin/member'); ?>><a href="<?php echo e(url ('admin/member')); ?>"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'><?php echo e($cobjuser->count()); ?></div></small>
          </span></a></li>
        </ul>
      </li>
      <?php endif; ?>


      <?php if(Auth::user()->role->slug == 'University' and Auth::user()->permit != 2): ?>
      <li class="treeview <?php echo e(classActiveOnlySegment(1,'univer')); ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li <?php echo classActivePath('univer/center'); ?>><a href="<?php echo e(url ('univer/center')); ?>"><i class="fa fa-circle-o"></i> ศูนย์จัดการเครือข่าย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'ccenter'><?php echo e($cobjcenter->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('univer/area'); ?>><a href="<?php echo e(url ('univer/area')); ?>"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'><?php echo e($cobjarea->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('univer/member'); ?>><a href="<?php echo e(url ('univer/member')); ?>"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'><?php echo e($cobjuser->count()); ?></div></small>
          </span></a></li>
        </ul>
      </li>
      <?php endif; ?>


      <?php if(Auth::user()->role->slug == 'Manager'): ?>
      <li class="treeview <?php echo e(classActiveOnlySegment(1,'managerset')); ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li <?php echo classActivePath('managerset/area'); ?>><a href="<?php echo e(url ('managerset/area')); ?>"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'><?php echo e($cobjarea->count()); ?></div></small>
          </span></a></li>
        <li <?php echo classActivePath('managerset/member'); ?>><a href="<?php echo e(url ('managerset/member')); ?>"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'><?php echo e($cobjuser->count()); ?></div></small>
          </span></a></li>
        </ul>
      </li>
      <?php endif; ?>

      <?php if(Auth::user()->role->slug == 'Operator'): ?>
      <li class="treeview <?php echo e(classActiveOnlySegment(1,'operatorset')); ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li <?php echo classActivePath('operatorset/member'); ?>><a href="<?php echo e(url ('operatorset/member')); ?>"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'><?php echo e($cobjuser->count()); ?></div></small>
          </span></a></li>
        </ul>
      </li>
      <?php endif; ?>

        <?php if(Auth::user()->role->slug == 'Operator'): ?>
        <li class="treeview <?php echo e(classActiveOnlySegment(1,'operator')); ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo classActivePath('operator/areauser'); ?>><a href="<?php echo e(url ('operator/areauser')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'><?php echo e($cobjarea->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('operator/expert'); ?>><a href="<?php echo e(url ('operator/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'><?php echo e($cobjexpert->count()); ?></div></small>
              </span></a></li>
          </ul>
        </li>
        <?php elseif(Auth::user()->role->slug == 'Manager'): ?>
        <li class="treeview <?php echo e(classActiveOnlySegment(1,'manager')); ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo classActivePath('manager/areauser'); ?>><a href="<?php echo e(url ('manager/areauser')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'><?php echo e($cobjarea->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('manager/expert'); ?>><a href="<?php echo e(url ('manager/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'><?php echo e($cobjexpert->count()); ?></div></small>
              </span></a></li>
            </ul>
          </li>
        <?php elseif(Auth::user()->permit != 2): ?>

        <li class="treeview <?php echo e(classActiveOnlySegment(1,'user')); ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo classActivePath('user/areauser'); ?>><a href="<?php echo e(url ('user/areauser')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'><?php echo e($cobjarea->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('user/expert'); ?>><a href="<?php echo e(url ('user/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'><?php echo e($cobjexpert->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('user/researcher'); ?>><a href="<?php echo e(url ('user/researcher')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cresearcher'><?php echo e($cobjresearcher->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('user/research'); ?>><a href="<?php echo e(url ('user/research')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลงานวิจัย
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cresearch'><?php echo e($cobjresearch->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('user/creative'); ?>><a href="<?php echo e(url ('user/creative')); ?>"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'ccreative'><?php echo e($cobjcreative->count()); ?></div></small>
              </span></a></li>
            <li <?php echo classActivePath('user/useful'); ?>><a href="<?php echo e(url ('user/useful')); ?>"><i class="fa fa-circle-o"></i> <span>การใช้ประโยชน์</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-gray"><div id = 'cuseful'><?php echo e($cobjuseful->count()); ?></div></small>
                </span></a></li>
            </ul>
          </li>
        <?php endif; ?>

    <li class="treeview <?php echo e(classActiveOnlySegment(1,'analyze')); ?>">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>วิเคราะห์ระบบ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('analyze/struct'); ?>><a href="<?php echo e(url('analyze/struct')); ?>"><i class="fa fa-circle-o"></i> กลุ่มข้อมูลตามโครงสร้าง</a></li>
        <li <?php echo classActivePath('analyze/recheck'); ?>><a href="<?php echo e(url('analyze/recheck')); ?>"><i class="fa fa-circle-o"></i> ตรวจสอบการบันทึกข้อมูล</a></li>
        <li <?php echo classActivePath('analyze/userlog'); ?>><a href="<?php echo e(url('analyze/userlog')); ?>"><i class="fa fa-circle-o"></i> ตรวจสอบข้อมูลผู้ใช้</a></li>
      </ul>
    </li>

    <?php if(Auth::user()->role->slug == 'Admin'): ?>
    <li class="treeview <?php echo e(classActiveOnlySegment(1,'mnt')); ?>">
      <a href="#">
        <i class="fa fa-cog"></i> <span>บำรุงรักษา</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('mnt/bkfile'); ?>><a href="<?php echo e(url('mnt/bkfile')); ?>"><i class="fa fa-circle-o"></i> สำรองไฟล์ระบบ</a></li>
        <li <?php echo classActivePath('mnt/bkdb'); ?>><a href="<?php echo e(url('mnt/bkdb')); ?>"><i class="fa fa-circle-o"></i> สำรองฐานข้อมูล</a></li>
      </ul>
    </li>
    <?php endif; ?>

    <li <?php echo classActivePath('user/infor'); ?>>
      <a href="<?php echo e(url ('user/infor')); ?>">
        <i class="fa fa-weixin"></i> <span>ข่าวสาร&กิจกรรม</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-gray"><div id = 'cinfor'><?php echo e($cobjinfor->count()); ?></div></small>
        </span>
      </a>
    </li>

    <li <?php echo classActivePath('user/question'); ?>>
      <a href="<?php echo e(url ('user/question')); ?>">
        <i class="fa fa-envelope"></i> <span>การสื่อสารกับนักวิจัย</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e($cobjquestion->count()); ?></div></small>
        </span>
      </a>
    </li>

<?php endif; ?>


    <li class="header">เมนูหลัก</li>
    <li <?php echo classActivePath('/'); ?>><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
      <span class="pull-right-container">
        <small class="label pull-right bg-gray"><div id = 'cquestion'><?php echo e('99'); ?></div></small>
      </span></a></li>
    <li <?php echo classActivePath('organize'); ?>><a href="<?php echo e(url('/organize')); ?>"><i class="fa fa-home"></i> ข้อมูลหน่วยงาน</a></li>
    <li <?php echo classActivePath('community'); ?>><a href="<?php echo e(url('community')); ?>"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span></a></li>
    <li <?php echo classActivePath('activity'); ?>><a href="<?php echo e(url('activity')); ?>"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span></a></li>
    <li <?php echo classActivePath('group'); ?>><a href="<?php echo e(url('group')); ?>"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span></a></li>
    <li <?php echo classActivePath('knowledge'); ?>><a href="<?php echo e(url('knowledge')); ?>"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span></a></li>
    <li <?php echo classActivePath('travel'); ?>><a href="<?php echo e(url('travel')); ?>"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span></a></li>
    <li <?php echo classActivePath('calendar'); ?>><a href="<?php echo e(url('calendar')); ?>"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span></a></li>
    <li <?php echo classActivePath('poll'); ?>><a href="<?php echo e(url('poll')); ?>"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span></a></li>
    <li <?php echo classActivePath('complaint'); ?>><a href="<?php echo e(url('complaint')); ?>"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span></a></li>
    <li <?php echo classActivePath('problem'); ?>><a href="<?php echo e(url('problem')); ?>"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span></a></li>
    <li <?php echo classActivePath('download'); ?>><a href="<?php echo e(url('download')); ?>"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร</a></li>
    <li <?php echo classActivePath('about'); ?>><a href="<?php echo e(url('about')); ?>"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
    <li><hr></li>
    <li <?php echo classActivePath('search'); ?>><a href="<?php echo e(url('search')); ?>"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
    <li <?php echo classActivePath('register'); ?>><a href="<?php echo e(url('register')); ?>"><i class="fa fa-user"></i> <span>สมัครสมาชิก</span></a></li>
        <!-- Authentication Links -->
        <?php if(Auth::guest()): ?>
            <li <?php echo classActivePath('login'); ?>><a href="<?php echo e(url('login')); ?>"><i class="fa fa-lock"></i> <span>เข้าสู่ระบบ</span></a></li>
        <?php else: ?>
            <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        <?php endif; ?>

  </ul>
</section>
