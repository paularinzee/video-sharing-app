<!DOCTYPE html>
<html>
<head>
@include('admin.inc.head')
</head>
<body class="hold-transition skin-blue layout-boxed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper"> @include('admin.inc.header')
  
  @include('admin.inc.sidebar')
  
  @yield('content') 
  
  <!-- ./wrapper --> 
  
  @include('admin.inc.footer') </div>
@include('admin.inc.foot')
</body>
</html>
