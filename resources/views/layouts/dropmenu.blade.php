@if (Auth::user())
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