@extends('front.layouts.default')
@section('content')
<main>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">My Account</a></li>
    <li class="breadcrumb-item"><a href="{{url('my-videos')}}">My Videos</a></li>
    <li class="breadcrumb-item active">{{$page_title}}</li>
  </ol>
  
  <!--Main layout-->
  <div class="container">
    <div class="row"> 
      
      <!--Main column-->
      <div class="col-lg-12"> 
        
        <!--First row-->
        <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-12">
            <div class="divider-new">
              <h2 class="h2-responsive">{{$page_title}}</h2>
            </div>
          </div>
        </div>
        <!--/.First row--> 
        <br>
        
        <!--Second row-->
        <div class="row">
          <div class="col-lg-12"> 
            
            <!--Naked Form-->
            <div class="card-block">

              @if (count($errors) > 0)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              @if(Session::has('success'))
              <div class="alert alert-success" role="alert">{{session('success')}}</div>
              @endif

              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}} 
                <!--Body-->
                <div class="md-form">
                  <input type="text" class="form-control" value="@if($video->type == 1) Uploaded Video @else Embeded Video @endif" disabled>
                  <label for="form34">Video Type</label>
                </div>
                <div class="md-form">
                  <input type="text" id="form32" name="title" class="form-control" value="{{Input::old('title',$video->title)}}">
                  <label for="form34">Title</label>
                </div>
                <div class="md-form" id="embed_code">
                  <textarea name="embed_code" class="form-control md-textarea" placeholder="For e.g, <iframe src=''></iframe>">{{Input::old('embed_code',$video->content)}}</textarea>
                  <label>Embed Code</label>
                </div>
                <div class="md-form">
                  <textarea name="description" class="form-control md-textarea">{{Input::old('description',$video->description)}}</textarea>
                  <label>Description</label>
                </div>

                <div class="md-form"> @php $selected = Input::old('category_id',$video->category_id); @endphp
                  <select class="mdb-select dropdown-primary" name="category_id">
                    <option value="" disabled selected>Select category</option>
                    
            @foreach($categories as $category)
            
                    <option value="{{$category->id}}" @if($category->id == $selected) selected @endif>{{$category->name}}</option>
                       
            @endforeach         
        
                  </select>
                  <label>Category</label>
                </div>
                <div class="md-form">
                  @if(!empty($video->thumbnail))<img src="{{$video->thumbnail}}" class="img-fluid">@endif

                  <div class="file-field">
                    <div class="btn btn-primary btn-sm float-left" style="line-height: 2rem;"> <span>Select Thumbnail</span>
                      <input type="file" name="thumbnail" accept="image/x-png,image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload thumbnail image">
                    </div>
                  </div>
                  <small>only jpg, png files are allowed. Recommended 320x180 . Maximum file size {{config('app.max_thumbnail_upload_size')}}MB</small> </div>


                <div class="md-form"> @php $selected = Input::old('published',$video->published); @endphp
                  <select class="mdb-select dropdown-primary" name="published">
                    <option value="1" @if(1 == $selected) selected @endif>Yes</option>
                    <option value="0" @if(0 == $selected) selected @endif>No</option>
                  </select>
                  <label>Published</label>
                </div>
                <div class="md-form">
                  <textarea name="tags" class="form-control md-textarea" placeholder="separated by comma">{{Input::old('tags',$video->tags)}}</textarea>
                  <label>Tags</label>
                </div>

                <div class="text-center">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!--Naked Form--> 
            
          </div>
        </div>
        <!--/.Second row--> 
        <br/>
      </div>
      <!--/.Main column--> 
      
    </div>
  </div>
  <!--/.Main layout--> 
  
</main>
@stop 