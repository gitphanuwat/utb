
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
  <li {!! classActivePath('admin/group') !!}><a href="{{ url ('admin/group') }}"><i class="fa fa-circle-o"></i> กลุ่มปัญหา
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'cgroup'>99</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/amphur') !!}><a href="{{ url ('admin/amphur') }}"><i class="fa fa-circle-o"></i> เขตอำเภอ
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'camphur'>99</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/organize') !!}><a href="{{ url ('admin/organize') }}"><i class="fa fa-circle-o"></i> หน่วยงาน
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'corganize'>99</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/village') !!}><a href="{{ url ('admin/village') }}"><i class="fa fa-circle-o"></i> พื้นที่ชุมชน
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'cvillages'>99</div></small>
    </span></a></li>
  <li {!! classActivePath('admin/member') !!}><a href="{{ url ('admin/member') }}"><i class="fa fa-circle-o"></i> สมาชิกระบบ
    <span class="pull-right-container">
      <small class="label pull-right bg-gray"><div id = 'cuser'>99</div></small>
    </span></a></li>
  </ul>
</li>
@endif

        <li class="header">เมนู:ข้อมูลหน่วยงาน</li>
        <li {!! classActivePath('organize') !!}><a href="{{ url('/managerset/organize')}}"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
        <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('organize') !!}><a href="{{ url('/managerset/organize')}}"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('organize') !!}><a href="{{ url('/managerset/person')}}"><i class="fa fa-home"></i><span>บุคลากร</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('community') !!}><a href="{{ url('/managerset/village')}}"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('group') !!}><a href="{{ url('/managerset/group')}}"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('activity') !!}><a href="{{ url('/managerset/activity')}}"><i class="fa fa-flag"></i> <span>เรื่องเด่นชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('travel') !!}><a href="{{ url('/managerset/travel')}}"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('calendar') !!}><a href="{{ url('/managerset/calendar')}}"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('problem') !!}><a href="{{ url('/managerset/problem')}}"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li><hr></li>
              <li {!! classActivePath('download') !!}><a href="{{ url('/managerset/download')}}"><i class="fa fa-newspaper-o"></i> ข่าวสาร&กิจกรรม
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('knowledge') !!}><a href="{{ url('/managerset/knowledge')}}"><i class="fa fa-wechat"></i> <span>บอร์ดสนทนา</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('poll') !!}><a href="{{ url('/managerset/poll')}}"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('complaint') !!}><a href="{{ url('/managerset/complaint')}}"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('download') !!}><a href="{{ url('/managerset/download')}}"><i class="fa fa-paperclip"></i> ดาวน์โหลดเอกสาร
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li><hr></li>
              <li {!! classActivePath('about') !!}><a href="{{ url('about')}}"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
              <li {!! classActivePath('search') !!}><a href="{{ url('search')}}"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
                  <!-- Authentication Links -->
@else
    <li class="header">เมนูหลัก</li>
    <li {!! classActivePath('/') !!}><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('organize') !!}><a href="{{ url('public/organize')}}"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('community') !!}><a href="{{ url('public/community')}}"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('group') !!}><a href="{{ url('group')}}"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('activity') !!}><a href="{{ url('activity')}}"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('travel') !!}><a href="{{ url('travel')}}"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('calendar') !!}><a href="{{ url('calendar')}}"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('problem') !!}><a href="{{ url('problem')}}"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('knowledge') !!}><a href="{{ url('knowledge')}}"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('poll') !!}><a href="{{ url('poll')}}"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('complaint') !!}><a href="{{ url('complaint')}}"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('download') !!}><a href="{{ url('download')}}"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('about') !!}><a href="{{ url('about')}}"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
    <li><hr></li>
    <li {!! classActivePath('search') !!}><a href="{{ url('search')}}"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
    <li {!! classActivePath('register') !!}><a href="{{ url('register')}}"><i class="fa fa-user"></i> <span>สมัครสมาชิก</span></a></li>
@endif

<!-- Authentication Links -->
@if (Auth::guest())
    <li {!! classActivePath('login') !!}><a href="{{ url('login')}}"><i class="fa fa-lock"></i> <span>เข้าสู่ระบบ</span></a></li>
@else
    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
@endif

  </ul>
</section>
