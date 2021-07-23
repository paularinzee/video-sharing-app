@extends('admin.layouts.default')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Users </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li><a href="{{url('admin/users')}}">Users</a></li>
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
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name',$user->name)}}" >
            @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email*</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email',$user->email)}}" >
            @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>

          <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
            <label>Role*</label>            
            @php $selected = old('role',$user->role); @endphp
            <select class="form-control" name="role">
              <option value="2" @if($selected == '2') selected @endif>Registered User</option>
              <option value="1" @if($selected == '1') selected @endif>Administrator</option>
            </select>
            @if ($errors->has('role')) <span class="help-block"> <strong>{{ $errors->first('role') }}</strong> </span> @endif 
          </div>

          <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
            <label>Status*</label>            
            @php $selected = old('active',$user->active); @endphp
            <select class="form-control" name="active">
              <option value="1" @if($selected == '1') selected @endif>Active</option>
              <option value="0" @if($selected == '0') selected @endif>Inactive</option>
              <option value="2" @if($selected == '2') selected @endif>Banned</option>              
            </select>
            @if ($errors->has('role')) <span class="help-block"> <strong>{{ $errors->first('role') }}</strong> </span> @endif 
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">
            @if ($errors->has('password_confirmation')) <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
            <a href="{{url('admin/users')}}" class="btn btn-default">Cancel</a> </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop