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
      @if (Auth::guest())
      <img src="{{ asset("/images/lrd_logo.png") }}"  alt="Local Research Development">
      @elseif (Auth::user()->picture)
      <img src="{{ asset("/images/avatar/large") }}/{{ Auth::user()->picture }}" class="img-circle" alt="Local Research Development">
      @else
      <img src="{{ asset("/images/no_image.png") }}"  class="img-circle"  alt="Local Research Development">
      @endif
    </div>

    @if (Auth::guest())
    <div class="pull-left info">
      <p>Lrd System</p>
      <a href="#">Local Research Development.</a>
    </div>
    @else
    <div class="pull-left info">
    <p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
    <a href="#"><i class="fa fa-circle text-success"></i> ระดับ : {{ Auth::user()->role->title }}{!! Auth::user()->permit==2? '(ผู้บริหาร)' : '' !!}<br>
      @if (Auth::user()->role->slug == 'University')
        {{ Auth::user()->university->name }}
      @endif
      @if (Auth::user()->role->slug == 'Manager')
        {{ Auth::user()->center->name }}
      @endif
      @if (Auth::user()->role->slug == 'Operator')
        {{ Auth::user()->area->name }}
      @endif
    </a>
    </div>
    @endif

  </div>

  <!-- search form -->
  <form action="{{ url('search') }}" method="POST" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search...">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <span class="input-group-btn">
            <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- sidebar menu: : style can be found in sidebar.less -->

<ul class="sidebar-menu">

@if (Auth::user())
    <li class="header">เมนู:บริหารข้อมูล</li>
      @if (Auth::user()->role->slug == 'Admin')
      <li class="treeview {{ classActiveOnlySegment(1,'admin') }}">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li {!! classActivePath('admin/group') !!}><a href="{{ url ('admin/group') }}"><i class="fa fa-circle-o"></i> กลุ่มปัญหาวิจัย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cgroup'>{{ $cobjgroup->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('admin/university') !!}><a href="{{ url ('admin/university') }}"><i class="fa fa-circle-o"></i> มหาวิทยาลัย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuniver'>{{ $cobjuniver->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('admin/center') !!}><a href="{{ url ('admin/center') }}"><i class="fa fa-circle-o"></i> ศูนย์จัดการเครือข่าย
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'ccenter'>{{ $cobjcenter->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('admin/area') !!}><a href="{{ url ('admin/area') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'>{{ $cobjarea->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('admin/member') !!}><a href="{{ url ('admin/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'>{{ $cobjuser->count() }}</div></small>
          </span></a></li>
        </ul>
      </li>
      @endif


      @if (Auth::user()->role->slug == 'University' and Auth::user()->permit != 2)
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
            <small class="label pull-right bg-gray"><div id = 'ccenter'>{{ $cobjcenter->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('univer/area') !!}><a href="{{ url ('univer/area') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'>{{ $cobjarea->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('univer/member') !!}><a href="{{ url ('univer/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'>{{ $cobjuser->count() }}</div></small>
          </span></a></li>
        </ul>
      </li>
      @endif


      @if (Auth::user()->role->slug == 'Manager')
      <li class="treeview {{ classActiveOnlySegment(1,'managerset') }}">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li {!! classActivePath('managerset/area') !!}><a href="{{ url ('managerset/area') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'careas'>{{ $cobjarea->count() }}</div></small>
          </span></a></li>
        <li {!! classActivePath('managerset/member') !!}><a href="{{ url ('managerset/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'>{{ $cobjuser->count() }}</div></small>
          </span></a></li>
        </ul>
      </li>
      @endif

      @if (Auth::user()->role->slug == 'Operator')
      <li class="treeview {{ classActiveOnlySegment(1,'operatorset') }}">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>ตั้งค่าระบบ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li {!! classActivePath('operatorset/member') !!}><a href="{{ url ('operatorset/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
          <span class="pull-right-container">
            <small class="label pull-right bg-gray"><div id = 'cuser'>{{ $cobjuser->count() }}</div></small>
          </span></a></li>
        </ul>
      </li>
      @endif

        @if (Auth::user()->role->slug == 'Operator')
        <li class="treeview {{ classActiveOnlySegment(1,'operator') }}">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {!! classActivePath('operator/areauser') !!}><a href="{{ url ('operator/areauser') }}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'>{{ $cobjarea->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('operator/expert') !!}><a href="{{ url ('operator/expert') }}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'>{{ $cobjexpert->count() }}</div></small>
              </span></a></li>
          </ul>
        </li>
        @elseif (Auth::user()->role->slug == 'Manager')
        <li class="treeview {{ classActiveOnlySegment(1,'manager') }}">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {!! classActivePath('manager/areauser') !!}><a href="{{ url ('manager/areauser') }}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'>{{ $cobjarea->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('manager/expert') !!}><a href="{{ url ('manager/expert') }}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'>{{ $cobjexpert->count() }}</div></small>
              </span></a></li>
            </ul>
          </li>
        @elseif (Auth::user()->permit != 2)

        <li class="treeview {{ classActiveOnlySegment(1,'user') }}">
          <a href="#">
            <i class="fa fa-edit"></i> <span>จัดการข้อมูลระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {!! classActivePath('user/areauser') !!}><a href="{{ url ('user/areauser') }}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'>{{ $cobjarea->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('user/expert') !!}><a href="{{ url ('user/expert') }}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'>{{ $cobjexpert->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('user/researcher') !!}><a href="{{ url ('user/researcher') }}"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cresearcher'>{{ $cobjresearcher->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('user/research') !!}><a href="{{ url ('user/research') }}"><i class="fa fa-circle-o"></i> ข้อมูลงานวิจัย
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cresearch'>{{ $cobjresearch->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('user/creative') !!}><a href="{{ url ('user/creative') }}"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'ccreative'>{{ $cobjcreative->count() }}</div></small>
              </span></a></li>
            <li {!! classActivePath('user/useful') !!}><a href="{{ url ('user/useful') }}"><i class="fa fa-circle-o"></i> <span>การใช้ประโยชน์</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-gray"><div id = 'cuseful'>{{ $cobjuseful->count() }}</div></small>
                </span></a></li>
            </ul>
          </li>
        @endif

    <li class="treeview {{ classActiveOnlySegment(1,'analyze') }}">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>วิเคราะห์ระบบ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('analyze/struct') !!}><a href="{{ url('analyze/struct')}}"><i class="fa fa-circle-o"></i> กลุ่มข้อมูลตามโครงสร้าง</a></li>
        <li {!! classActivePath('analyze/recheck') !!}><a href="{{ url('analyze/recheck')}}"><i class="fa fa-circle-o"></i> ตรวจสอบการบันทึกข้อมูล</a></li>
        <li {!! classActivePath('analyze/userlog') !!}><a href="{{ url('analyze/userlog')}}"><i class="fa fa-circle-o"></i> ตรวจสอบข้อมูลผู้ใช้</a></li>
      </ul>
    </li>

    @if (Auth::user()->role->slug == 'Admin')
    <li class="treeview {{ classActiveOnlySegment(1,'mnt') }}">
      <a href="#">
        <i class="fa fa-cog"></i> <span>บำรุงรักษา</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('mnt/bkfile') !!}><a href="{{ url('mnt/bkfile')}}"><i class="fa fa-circle-o"></i> สำรองไฟล์ระบบ</a></li>
        <li {!! classActivePath('mnt/bkdb') !!}><a href="{{ url('mnt/bkdb')}}"><i class="fa fa-circle-o"></i> สำรองฐานข้อมูล</a></li>
      </ul>
    </li>
    @endif

    <li {!! classActivePath('user/infor') !!}>
      <a href="{{ url ('user/infor') }}">
        <i class="fa fa-weixin"></i> <span>ข่าวสาร&กิจกรรม</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-gray"><div id = 'cinfor'>{{ $cobjinfor->count() }}</div></small>
        </span>
      </a>
    </li>

    <li {!! classActivePath('user/question') !!}>
      <a href="{{ url ('user/question') }}">
        <i class="fa fa-envelope"></i> <span>การสื่อสารกับนักวิจัย</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-gray"><div id = 'cquestion'>{{ $cobjquestion->count() }}</div></small>
        </span>
      </a>
    </li>

@endif

    <li class="header">ระบบสารสนเทศ</li>
    <li>
      <a href="{{ url ('/') }}">
        <i class="fa fa-dashboard"></i> <span>หน้าหลัก</span>
      </a>
    </li>
    <li class="treeview {{ classActiveOnlySegment(1,'eis') }}">
      <a href="#">
        <i class="fa fa-pie-chart"></i> <span>สารสนเทศเชิงพื้นที่</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('eis/researcher') !!}><a href="{{ url('eis/researcher')}}"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย</a></li>
        <li {!! classActivePath('eis/expert') !!}><a href="{{ url('eis/expert')}}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ</a></li>
        <li {!! classActivePath('eis/research') !!}><a href="{{ url('eis/research')}}"><i class="fa fa-circle-o"></i> ข้อมูลผลงานวิจัย</a></li>
        <li {!! classActivePath('eis/creative') !!}><a href="{{ url('eis/creative')}}"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์</a></li>
        <li {!! classActivePath('eis/area') !!}><a href="{{ url('eis/area')}}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน</a></li>
        <li {!! classActivePath('eis/problem') !!}><a href="{{ url('eis/problem')}}"><i class="fa fa-circle-o"></i> ข้อมูลปัญหาชุมชน</a></li>
      </ul>
    </li>

    <li class="treeview {{ classActiveOnlySegment(1,'dss') }}">
      <a href="#">
        <i class="fa fa-bar-chart-o"></i> <span>ระบบสนับสนุนการตัดสินใจ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('dss/topic') !!}><a href="{{ url('dss/topic')}}"><i class="fa fa-circle-o"></i> สนับสนุนโจทย์วิจัย</a></li>
        <li {!! classActivePath('dss/useful') !!}><a href="{{ url('dss/useful')}}"><i class="fa fa-circle-o"></i> ผลการนำใช้ระบบ</a></li>
        <li {!! classActivePath('dss/system') !!}><a href="{{ url('dss/system')}}"><i class="fa fa-circle-o"></i> สารสนเทศเชิงระบบ</a></li>
      </ul>
    </li>

    <li class="treeview {{ classActiveOnlySegment(1,'report') }}">
      <a href="#">
        <i class="fa fa-reorder"></i> <span>รายงานข้อมูล</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('report/researcher') !!}><a href="{{ url('report/researcher')}}"><i class="fa fa-circle-o"></i> ข้อมูลนักวิจัย</a></li>
        <li {!! classActivePath('report/expert') !!}><a href="{{ url('report/expert')}}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ</a></li>
        <li {!! classActivePath('report/research') !!}><a href="{{ url('report/research')}}"><i class="fa fa-circle-o"></i> ข้อมูลผลงานวิจัย</a></li>
        <li {!! classActivePath('report/creative') !!}><a href="{{ url('report/creative')}}"><i class="fa fa-circle-o"></i> ผลงานสร้างสรรค์</a></li>
        <li {!! classActivePath('report/area') !!}><a href="{{ url('report/area')}}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน</a></li>
        <li {!! classActivePath('report/problem') !!}><a href="{{ url('report/problem')}}"><i class="fa fa-circle-o"></i> ปัญหาในพื้นที่ชุมชน</a></li>
      </ul>
    </li>

    <li class="treeview {{ classActiveOnlySegment(1,'about') }}">
      <a href="#">
        <i class="fa fa-th-large"></i> <span>เกี่ยวกับระบบ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li {!! classActivePath('about/system') !!}><a href="{{ url('about/system')}}"><i class="fa fa-circle-o"></i> รายละเอียดระบบ</a></li>
        <li {!! classActivePath('about/project') !!}><a href="{{ url('about/project')}}"><i class="fa fa-circle-o"></i> ข้อมูลโครงการ</a></li>
        <li {!! classActivePath('about/as') !!}><a href="{{ url('about/as')}}"><i class="fa fa-circle-o"></i> เกี่ยวกับผู้จัดทำ</a></li>
        <li {!! classActivePath('about/updateshow') !!}><a href="{{ url('about/updateshow')}}"><i class="fa fa-circle-o"></i> การอัพเดทระบบ</a></li>
      </ul>
    </li>
    <li {!! classActivePath('search') !!}><a href="{{ url ('search') }}"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url ('login') }}"><i class="fa fa-user"></i> <span>เข้าระบบสมาชิก</span></a></li>
        @else
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        @endif

  </ul>
</section>
