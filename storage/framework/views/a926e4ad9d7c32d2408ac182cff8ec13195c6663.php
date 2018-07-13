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
      <p>Lrd System</p>
      <a href="#">Local Research Development.</a>
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

    <li class="header">ระบบสารสนเทศ</li>
    <li>
      <a href="<?php echo e(url ('/')); ?>">
        <i class="fa fa-dashboard"></i> <span>หน้าหลัก</span>
      </a>
    </li>
    <li class="treeview <?php echo e(classActiveOnlySegment(1,'eis')); ?>">
      <a href="#">
        <i class="fa fa-pie-chart"></i> <span>สารสนเทศเชิงพื้นที่</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('eis/researcher'); ?>><a href="<?php echo e(url('eis/researcher')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย</a></li>
        <li <?php echo classActivePath('eis/expert'); ?>><a href="<?php echo e(url('eis/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ</a></li>
        <li <?php echo classActivePath('eis/research'); ?>><a href="<?php echo e(url('eis/research')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผลงานวิจัย</a></li>
        <li <?php echo classActivePath('eis/creative'); ?>><a href="<?php echo e(url('eis/creative')); ?>"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์</a></li>
        <li <?php echo classActivePath('eis/area'); ?>><a href="<?php echo e(url('eis/area')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน</a></li>
        <li <?php echo classActivePath('eis/problem'); ?>><a href="<?php echo e(url('eis/problem')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลปัญหาชุมชน</a></li>
      </ul>
    </li>

    <li class="treeview <?php echo e(classActiveOnlySegment(1,'dss')); ?>">
      <a href="#">
        <i class="fa fa-bar-chart-o"></i> <span>ระบบสนับสนุนการตัดสินใจ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('dss/topic'); ?>><a href="<?php echo e(url('dss/topic')); ?>"><i class="fa fa-circle-o"></i> สนับสนุนโจทย์วิจัย</a></li>
        <li <?php echo classActivePath('dss/useful'); ?>><a href="<?php echo e(url('dss/useful')); ?>"><i class="fa fa-circle-o"></i> ผลการนำใช้ระบบ</a></li>
        <li <?php echo classActivePath('dss/system'); ?>><a href="<?php echo e(url('dss/system')); ?>"><i class="fa fa-circle-o"></i> สารสนเทศเชิงระบบ</a></li>
      </ul>
    </li>

    <li class="treeview <?php echo e(classActiveOnlySegment(1,'report')); ?>">
      <a href="#">
        <i class="fa fa-reorder"></i> <span>รายงานข้อมูล</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('report/researcher'); ?>><a href="<?php echo e(url('report/researcher')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย</a></li>
        <li <?php echo classActivePath('report/expert'); ?>><a href="<?php echo e(url('report/expert')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ</a></li>
        <li <?php echo classActivePath('report/research'); ?>><a href="<?php echo e(url('report/research')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลผลงานวิจัย</a></li>
        <li <?php echo classActivePath('report/creative'); ?>><a href="<?php echo e(url('report/creative')); ?>"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์</a></li>
        <li <?php echo classActivePath('report/area'); ?>><a href="<?php echo e(url('report/area')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน</a></li>
        <li <?php echo classActivePath('report/problem'); ?>><a href="<?php echo e(url('report/problem')); ?>"><i class="fa fa-circle-o"></i> ปัญหาในพื้นที่ชุมชน</a></li>
      </ul>
    </li>

    <li class="treeview <?php echo e(classActiveOnlySegment(1,'about')); ?>">
      <a href="#">
        <i class="fa fa-th-large"></i> <span>เกี่ยวกับระบบ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?php echo classActivePath('about/system'); ?>><a href="<?php echo e(url('about/system')); ?>"><i class="fa fa-circle-o"></i> รายละเอียดระบบ</a></li>
        <li <?php echo classActivePath('about/project'); ?>><a href="<?php echo e(url('about/project')); ?>"><i class="fa fa-circle-o"></i> ข้อมูลโครงการ</a></li>
        <li <?php echo classActivePath('about/as'); ?>><a href="<?php echo e(url('about/as')); ?>"><i class="fa fa-circle-o"></i> เกี่ยวกับผู้จัดทำ</a></li>
        <li <?php echo classActivePath('about/updateshow'); ?>><a href="<?php echo e(url('about/updateshow')); ?>"><i class="fa fa-circle-o"></i> การอัพเดทระบบ</a></li>
      </ul>
    </li>
    <li <?php echo classActivePath('search'); ?>><a href="<?php echo e(url ('search')); ?>"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
        <!-- Authentication Links -->
        <?php if(Auth::guest()): ?>
            <li><a href="<?php echo e(url ('login')); ?>"><i class="fa fa-user"></i> <span>เข้าระบบสมาชิก</span></a></li>
        <?php else: ?>
            <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        <?php endif; ?>

  </ul>
</section>
