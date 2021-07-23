
<header class="main-header"> 
  <!-- Logo --> 
  <a href="{{url('admin/dashboard')}}" class="logo"> 
  <!-- mini logo for sidebar mini 50x50 pixels --> 
  <span class="logo-mini"><b>{{config('app.site_name')}}</b></span> 
  <!-- logo for regular state and mobile devices --> 
  <span class="logo-lg">{{config('app.site_name')}}</span> </a> 
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top"> 
    <!-- Sidebar toggle button--> 
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li><a href="{{url('/')}}" target="_blank">View Site</a></li>
        
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{'https://placehold.it/160x160/00a65a/ffffff/&text='.Auth::user()->name[0]}}" class="user-image" alt="User Image"> <span class="hidden-xs">{{Auth::user()->name}}</span> </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header"> <img src="{{'https://placehold.it/160x160/00a65a/ffffff/&text='.Auth::user()->name[0]}}" class="img-circle" alt="User Image">
              <p> {{Auth::user()->name}} <small>{{Auth::user()->email}}</small> </p>
            </li>
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="{{url('admin/profile')}}" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> </li>
      </ul>
    </div>
  </nav>
</header>

<!-- =============================================== -->