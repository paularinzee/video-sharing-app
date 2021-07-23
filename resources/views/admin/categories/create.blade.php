@extends('admin.layouts.default')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Categories </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li class="active">{{$page_title}}</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{$page_title}}</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools --> 
      </div>
      <!-- /.box-header -->
      <div class="box-body pad "> @if ($errors->any())
        <div class="form-group">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! implode('', $errors->all('
            <li>:message</li>
            ')) !!} </div>
        </div>
        @endif
        
        @if(session('success'))
        <div class="form-group">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('success')}} </div>
        </div>
        @endif
        <form method="post">
          {{csrf_field()}}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Name*</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}" >
            @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
            <a href="{{url('admin/categories')}}" class="btn btn-default">Cancel</a> </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop