@extends('admin.layouts.default')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Admin</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="callout callout-info">
      <p>Welcome {{Auth::user()->name}}</p>
    </div>
    <div class="row">
      <div class="col-lg-4 col-xs-12"> 
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{\App\Video::count()}}</h3>
            <p>Uploaded - {{\App\Video::where('type',1)->count()}}, Embeded - {{\App\Video::where('type',2)->count()}}</p>
          </div>
          <div class="icon"> <i class="fa fa-video-camera"></i> </div>
          <a href="{{url('admin/videos')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-xs-12"> 
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{\App\Page::count()}}</h3>
            <p>Pages</p>
          </div>
          <div class="icon"> <i class="fa fa-file"></i> </div>
          <a href="{{url('admin/pages')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-xs-12"> 
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{\App\User::count()}}</h3>
            <p>Users</p>
          </div>
          <div class="icon"> <i class="ion ion-person-add"></i> </div>
          <a href="{{url('admin/users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
      </div>
      
      <!-- ./col --> 
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop