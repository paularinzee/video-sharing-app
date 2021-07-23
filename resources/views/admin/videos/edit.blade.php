@extends('admin.layouts.default')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Videos </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li><a href="{{url('admin/videos')}}">Videos</a></li>
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
        <form method="post" action="" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label>Title*</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title',$video->title)}}" >
            @if ($errors->has('title')) <span class="help-block"> <strong>{{ $errors->first('title') }}</strong> </span> @endif </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label>Description</label>   
            <textarea class="form-control" name="description" placeholder="Description">{{old('description',$video->description)}}</textarea>
            @if ($errors->has('description')) 
              <span class="help-block"> <strong>{{ $errors->first('description') }}</strong> </span> 
            @endif 
          </div>            

          <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
            <label>Thumbnail</label>   
            <img src="{{$video->thumbnail}}" class="img-responsive">
            <input type="file" name="thumbnail" accept="image/png,image/jpeg" class="form-control">
                    <small>only jpg, png files are allowed. Recommended 320x180 . Maximum file size {{config('app.max_thumbnail_upload_size')}}MB</small>
            @if ($errors->has('thumbnail')) 
              <span class="help-block"> <strong>{{ $errors->first('thumbnail') }}</strong> </span> 
            @endif 
          </div>           



          @if($video->type == 2)
          <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            <label>Embed Code</label>   
            <textarea class="form-control" name="content" placeholder="Embed Code">{{old('content',$video->content)}}</textarea>
            @if ($errors->has('content')) 
              <span class="help-block"> <strong>{{ $errors->first('content') }}</strong> </span> 
            @endif 
          </div>  
          @endif        

          <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label>Category*</label> 
            @php $selected = old('category_id',$video->category_id); @endphp  
            <select class="form-control" name="category_id">
              @foreach($categories as $category)
                <option value="{{$category->id}}" @if($selected == $category->id) selected @endif>{{$category->name}}</option>
              @endforeach
            </select>

            @if ($errors->has('category_id')) 
              <span class="help-block"> <strong>{{ $errors->first('category_id') }}</strong> </span> 
            @endif 
          </div>

          <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
            <label>Published*</label> 
            @php $selected = old('published',$video->published); @endphp  
            <select class="form-control" name="published">
                <option value="1" @if($selected == 1) selected @endif>Yes</option>
                <option value="0" @if($selected == 0) selected @endif>No</option>
            </select>

            @if ($errors->has('published')) 
              <span class="help-block"> <strong>{{ $errors->first('published') }}</strong> </span> 
            @endif 
          </div>

          <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label>Status*</label> 
            @php $selected = old('status',$video->status); @endphp  
            <select class="form-control" name="status">
                <option value="1" @if($selected == 1) selected @endif>Approved</option>
                <option value="0" @if($selected == 0) selected @endif>Pending</option>
            </select>

            @if ($errors->has('status')) 
              <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span> 
            @endif 
          </div>          

          <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
            <label>Featured*</label> 
            @php $selected = old('featured',$video->featured); @endphp  
            <select class="form-control" name="featured">
                <option value="1" @if($selected == 1) selected @endif>Yes</option>
                <option value="0" @if($selected == 0) selected @endif>No</option>
            </select>

            @if ($errors->has('featured')) 
              <span class="help-block"> <strong>{{ $errors->first('featured') }}</strong> </span> 
            @endif 
          </div>


          <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
            <label>Tags</label>   
            <textarea class="form-control" name="tags" placeholder="keywords separated by comma">{{old('tags',$video->tags)}}</textarea>
            @if ($errors->has('tags')) 
              <span class="help-block"> <strong>{{ $errors->first('tags') }}</strong> </span> 
            @endif 
          </div> 


          <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
            <a href="{{url('admin/videos')}}" class="btn btn-default">Cancel</a> </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop