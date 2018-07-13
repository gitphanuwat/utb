
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

        <li class="header">เมนู:ข้อมูลหน่วยงาน</li>
        <li {!! classActivePath('/') !!}><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
          <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>

            <li {!! classActivePath('manager/areauser') !!}><a href="{{ url ('manager/areauser') }}"><i class="fa fa-circle-o"></i> ข้อมูลพื้นที่ชุมชน
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'carea'>{{ '99' }}</div></small>
              </span></a></li>
            <li {!! classActivePath('manager/expert') !!}><a href="{{ url ('manager/expert') }}"><i class="fa fa-circle-o"></i> ข้อมูลผู้เชี่ยวชาญ
              <span class="pull-right-container">
                <small class="label pull-right bg-gray"><div id = 'cexpert'>{{ '99' }}</div></small>
              </span></a></li>

              <li {!! classActivePath('organize') !!}><a href="{{ url('/managerset/organize')}}"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('community') !!}><a href="{{ url('/managerset/village')}}"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('activity') !!}><a href="{{ url('/managerset/activity')}}"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('group') !!}><a href="{{ url('/managerset/group')}}"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('knowledge') !!}><a href="{{ url('/managerset/knowledge')}}"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('travel') !!}><a href="{{ url('/managerset/travel')}}"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('calendar') !!}><a href="{{ url('/managerset/calendar')}}"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('poll') !!}><a href="{{ url('/managerset/poll')}}"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('complaint') !!}><a href="{{ url('/managerset/complaint')}}"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('problem') !!}><a href="{{ url('/managerset/problem')}}"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('download') !!}><a href="{{ url('/managerset/download')}}"><i class="fa fa-file-text-o"></i> ดาวน์โหลดเอกสาร
                <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
              <li {!! classActivePath('user/infor') !!}>
                <a href="{{ url ('user/infor') }}">
                  <i class="fa fa-weixin"></i> <span>ข่าวสาร&กิจกรรม</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-gray"><div id = 'cinfor'>{{ '88' }}</div></small>
                  </span>
                </a>
              </li>
              <li {!! classActivePath('user/question') !!}>
                <a href="{{ url ('user/question') }}">
                  <i class="fa fa-envelope"></i> <span>การสื่อสารกับนักวิจัย</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '88' }}</div></small>
                  </span>
                </a>
              </li>
              <li><hr></li>
              <li {!! classActivePath('about') !!}><a href="{{ url('about')}}"><i class="fa fa-book"></i> เกี่ยวกับระบบ</a></li>
              <li {!! classActivePath('search') !!}><a href="{{ url('search')}}"><i class="fa fa-search"></i> <span>ค้นหาข้อมูล</span></a></li>
                  <!-- Authentication Links -->
@else
    <li class="header">เมนูหลัก</li>
    <li {!! classActivePath('/') !!}><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> <span>ศูนย์ข้อมูลข่าวสาร</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('organize') !!}><a href="{{ url('/organize')}}"><i class="fa fa-home"></i><span>ข้อมูลหน่วยงาน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('community') !!}><a href="{{ url('community')}}"><i class="fa fa-users"></i> <span>ข้อมูลชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('activity') !!}><a href="{{ url('activity')}}"><i class="fa fa-flag"></i> <span>กิจกรรมเด่นชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('group') !!}><a href="{{ url('group')}}"><i class="fa fa-tags"></i> <span>การรวมกลุ่มชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('knowledge') !!}><a href="{{ url('knowledge')}}"><i class="fa fa-wechat"></i> <span>แลกเปลี่ยนเรียนรู้</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('travel') !!}><a href="{{ url('travel')}}"><i class="fa fa-image"></i> <span>แหล่งท่องเที่ยว</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('calendar') !!}><a href="{{ url('calendar')}}"><i class="fa fa-calendar"></i> <span>ปฏิทินกิจกรรมชุมชน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('poll') !!}><a href="{{ url('poll')}}"><i class="fa fa-server"></i> <span>สำรวจความคิดเห็น</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('complaint') !!}><a href="{{ url('complaint')}}"><i class="fa fa-legal"></i> <span>เรื่องร้องเรียน</span>
      <span class="pull-right-container"><small class="label pull-right bg-gray"><div id = 'cquestion'>{{ '99' }}</div></small></span></a></li>
    <li {!! classActivePath('problem') !!}><a href="{{ url('problem')}}"><i class="fa fa-question"></i> <span>ปัญหาชุมชน</span>
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
