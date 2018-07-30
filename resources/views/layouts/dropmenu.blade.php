@if (Auth::user())
<ul class="nav navbar-nav">

  <!-- Notifications: style can be found in dropdown.less -->

  <!-- Tasks: style can be found in dropdown.less -->
  
  <!-- User Account: style can be found in dropdown.less -->
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      @if (Auth::user()->picture)
      <img src="{{ asset('/images/avatar/large') }}/{{ Auth::user()->picture }}" class="img-circle" style="width:20px">
      @else
      <img src="{{ asset('/images/no_image.png') }}"  class="img-circle" style="width:20px">
      @endif
      <span class="hidden-xs">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
    </a>
    <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
        @if (Auth::user()->picture)
        <img src="{{ asset("/images/avatar/large") }}/{{ Auth::user()->picture }}" class="img-circle" alt="Local Research Development">
        @else
        <img src="{{ asset("/images/no_image.png") }}"  class="img-circle" alt="Local Research Development">
        @endif
        <p>
          {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
          <small>Member since {{ Auth::user()->created_at }}</small>
        </p>
      </li>

      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="{{ url('profile/show')}}" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
          <a href="{{ url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
        </div>
      </li>
    </ul>
  </li>
</ul>
@else
<ul class="nav navbar-nav">
  <!-- User Account: style can be found in dropdown.less -->
  <li class="pull-right">
    <a href="{{ url('/login')}}">
      <span class="hidden-xs"><i class="fa fa-user"></i> Member Login..</span>
    </a>
  </li>
</ul>
@endif
