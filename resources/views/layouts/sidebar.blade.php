<?php
use App\Type;

use App\Social;
use App\Organize;
use App\Person;
use App\Village;
use App\Group;
use App\Activity;
use App\Tourist;
use App\Event;
use App\Problem;

use App\Info;
use App\Polltopic;
use App\Complaint;
use App\Download;

use App\Amphur;
use App\User;


if(Auth::user()){
  if(Auth::user()->role->slug == 'Organize'){
    $ido = Auth::user()->organize_id;
    //$csocial = Social::where('organize_id',$ido)->get();
    //$corganize = Organize::where('organize_id',$ido)->get();
    $cperson = Person::where('organize_id',$ido)->get();
    $cvillage = Village::where('organize_id',$ido)->get();
    $cgroup = Group::where('organize_id',$ido)->get();
    $cactivity = Activity::where('organize_id',$ido)->get();
    $ctourist = Tourist::where('organize_id',$ido)->get();
    $cevent = Event::where('organize_id',$ido)->get();
    $cproblem = Problem::where('organize_id',$ido)->get();

    $cinfo= Info::where('organize_id',$ido)->get();
    $cpolltopic = Polltopic::where('organize_id',$ido)->get();
    $ccomplaint = Complaint::where('organize_id',$ido)->get();
    $cdownload = Download::where('organize_id',$ido)->get();

  }elseif(Auth::user()->role->slug == 'Admin'){
    $camphur = Amphur::get();
    $corganize = Organize::get();
    $cvillage = Village::get();
    $cuser = User::get();
  }

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
      <p>UTB System</p>
      <a href="#">Uttaradit Book System.</a>
    </div>
    @else
    <div class="pull-left info">
    <p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
    <a href="#"><i class="fa fa-circle text-success"></i> ระดับ : {{ Auth::user()->role->title }}{!! Auth::user()->permit==2? '(ผู้บริหาร)' : '' !!}<br>

      @if (Auth::user()->role->slug == 'Organize')
        {{ Auth::user()->organize->name }}
      @endif

    </a>
    </div>
    @endif

  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->

<ul class="sidebar-menu">

@if (Auth::user())
@if (Auth::user()->role->slug == 'Admin')
<li class="header">เมนู:บริหารข้อมูล</li>
<li class="treeview {{ classActiveOnlySegment(1,'admin') }}">
  <a href="#">
    <i class="fa fa-laptop"></i>
    <span>ตั้งค่าระบบ</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
  <li {!! classActivePath('admin/amphur') !!}><a href="{{ url ('admin/amphur') }}"><i class="fa fa-circle-o"></i> เขตอำเภอ
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'camphur'>{{$camphur->count()}}</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/organize') !!}><a href="{{ url ('admin/organize') }}"><i class="fa fa-circle-o"></i> หน่วยงาน
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'corganize'>{{$corganize->count()}}</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/village') !!}><a href="{{ url ('admin/village') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'cvillages'>{{$cvillage->count()}}</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/member') !!}><a href="{{ url ('admin/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'cuser'>{{$cuser->count()}}</div></small>
    </span></a></li>
  </ul>
</li>
@endif
@if (Auth::user()->role->slug == 'Organize')
<li class="header">เมนู:ข้อมูลหน่วยงาน</li>
<li {!! classActivePath('managerset/social') !!}><a href="{{ url('/managerset/social')}}"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
<span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'csocial'></div></small></span></a></li>
<li {!! classActivePath('managerset/organize') !!}><a href="{{ url('/managerset/organize')}}"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'corganize'></div></small></span></a></li>
<li {!! classActivePath('managerset/person') !!}><a href="{{ url('/managerset/person')}}"><i class="fa fa-home"></i><span>บุคลากร</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cperson'>{{ $cperson->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/village') !!}><a href="{{ url('/managerset/village')}}"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cvillage'>{{ $cvillage->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/group') !!}><a href="{{ url('/managerset/group')}}"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cgroup'>{{ $cgroup->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/activity') !!}><a href="{{ url('/managerset/activity')}}"><i class="fa fa-flag"></i> <span>เรื่องเด่นชุมชน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cactivity'>{{ $cactivity->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/tourist') !!}><a href="{{ url('/managerset/tourist')}}"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'ctourist'>{{ $ctourist->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/event') !!}><a href="{{ url('/managerset/event')}}"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรม</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cevent'>{{ $cevent->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/problem') !!}><a href="{{ url('/managerset/problem')}}"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cproblem'>{{ $cproblem->count() }}</div></small></span></a></li>
<li><hr></li>
<li {!! classActivePath('managerset/info') !!}><a href="{{ url('/managerset/info')}}"><i class="fa fa-newspaper-o"></i> ข่าวสาร&กิจกรรม
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cinfo'>{{ $cinfo->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/polltopic') !!}><a href="{{ url('/managerset/polltopic')}}"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cpolltopic'>{{ $cpolltopic->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/complaint') !!}><a href="{{ url('/managerset/complaint')}}"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'ccomplaint'>{{ $ccomplaint->count() }}</div></small></span></a></li>
<li {!! classActivePath('managerset/download') !!}><a href="{{ url('/managerset/download')}}"><i class="fa fa-paperclip"></i> ดาวน์โหลดเอกสาร
  <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cdownload'>{{ $cdownload->count() }}</div></small></span></a></li>
<li><hr></li>
<li {!! classActivePath('managerset/search') !!}><a href="{{ url('search')}}"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
<!-- Authentication Links -->
@endif
@endif

<!-- Authentication Links -->
@if (Auth::guest())
    <li {!! classActivePath('login') !!}><a href="{{ url('login')}}"><i class="fa fa-lock"></i> <span>เข้าสู่ระบบ</span></a></li>
@else
    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
@endif

  </ul>
</section>
