<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar"> 
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar"> 
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image"> <img src="{{'https://placehold.it/160x160/00a65a/ffffff/&text='.Auth::user()->name[0]}}" class="img-circle" alt="User Image"> </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="@if(Route::currentRouteName() == 'dashboard'){{'active'}}@endif"> <a href="{{url('admin/dashboard')}}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'categories'){{'active'}}@endif"> <a href="{{url('admin/categories')}}"> <i class="fa fa-list"></i> <span>Categories</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'videos'){{'active'}}@endif"> <a href="{{url('admin/videos')}}"> <i class="fa fa-video-camera"></i> <span>Videos</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'reports'){{'active'}}@endif"> <a href="{{url('admin/reported-videos')}}"> <i class="fa fa-flag"></i> <span>Reported Videos</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'users'){{'active'}}@endif"> <a href="{{url('admin/users')}}"> <i class="fa fa-users"></i> <span>Users</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'pages'){{'active'}}@endif"> <a href="{{url('admin/pages')}}"> <i class="fa fa-file"></i> <span>Pages</span> </a> </li>
      <li class="@if(Route::currentRouteName() == 'settings'){{'active'}}@endif"> <a href="{{url('admin/settings')}}"> <i class="fa fa-cogs"></i> <span>Settings</span> </a> </li>
      <li class="header">ACCOUNT</li>
      <li><a href="{{url('admin/logout')}}"><i class="fa fa-sign-out text-yellow"></i> <span>Sign Out</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar --> 
</aside>

<!-- =============================================== -->