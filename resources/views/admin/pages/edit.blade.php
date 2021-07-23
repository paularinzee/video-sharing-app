@extends('admin.layouts.default')

@section('after_styles') 
<!-- DataTables -->
<link rel="stylesheet" href="{{url('vendor/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@stop

@section('after_scripts') 
<!-- DataTables --> 
<script src="{{url('vendor/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script> 
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script> 
@stop

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Pages </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li><a href="{{url('admin/pages')}}">Pages</a></li>
      <li class="active">Edit</li>
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
      <div class="box-body pad"> @if ($errors->any())
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
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label>Title</label>
            <input type="text" class="form-control" name="title" placeholder="Page Title" value="{{old('title',$page->title)}}">
            @if ($errors->has('title')) <span class="help-block"> <strong>{{ $errors->first('title') }}</strong> </span> @endif </div>
          <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            <label>Content</label>
            <textarea class="textarea" name="content" placeholder="Page content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!old('content',$page->content)!!}</textarea>
            @if ($errors->has('content')) <span class="help-block"> <strong>{{ $errors->first('content') }}</strong> </span> @endif </div>
          <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            <label>Active</label>
            @php
            $selected = old('active',$page->active);
            @endphp
            <select class="form-control" name="active">
              <option value="1" @if($selected == 1) selected @endif>Yes</option>
              <option value="0" @if($selected == 0) selected @endif>No</option>
            </select>
            @if ($errors->has('active')) <span class="help-block"> <strong>{{ $errors->first('active') }}</strong> </span> @endif </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
            <a href="{{url('admin/pages')}}" class="btn btn-default">Cancel</a> </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop