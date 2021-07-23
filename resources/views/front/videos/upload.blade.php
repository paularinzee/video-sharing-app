@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
@stop

@section('after_scripts') 
<script type="text/javascript">
$("#video_type").on('change', function(event) {
    setVideoType();
});    

function setVideoType()
{
    if($('#video_type').val() == '1'){
        $('#embed_code').addClass('hidden');
        $('#video_file').removeClass('hidden');
   } 
   else{
        $('#embed_code').removeClass('hidden');
        $('#video_file').addClass('hidden');
   }
}
setVideoType();
</script> 
@stop

@section('content')
<main>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">My Account</a></li>
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
              <div class="alert alert-success" role="alert">{!!session('success')!!}</div>
              @endif

              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}} 
                <!--Body-->

                <div class="md-form"> @php $selected = Input::old('type'); @endphp
                  <select class="mdb-select colorful-select dropdown-primary" name="type" id="video_type">
                   @if(config('app.user_upload') == 1 || \Auth::user()->role == 1) <option value="1" @if($selected == 1) selected @endif>Upload Video</option>@endif
                   @if(config('app.user_embed') == 1 || \Auth::user()->role == 1) <option value="2" @if($selected == 2) selected @endif>Embed Video</option>@endif
                  </select>
                  <label>Video Type</label>
                </div>
                <div class="md-form">
                  <input type="text" id="form32" name="title" class="form-control" value="{{Input::old('title')}}" required>
                  <label for="form34">Title</label>
                </div>
                <div class="md-form">
                  <textarea name="description" class="form-control md-textarea">{{Input::old('description')}}</textarea>
                  <label>Description</label>
                </div>
                <div class="md-form"> @php $selected = Input::old('category_id'); @endphp
                  <select class="mdb-select dropdown-primary" name="category_id" required>
                    <option value="" disabled>Select category</option>
                    
            @foreach($categories as $category)
            
                    <option value="{{$category->id}}" @if($category->id == $selected) selected @endif>{{$category->name}}</option>
                       
            @endforeach         
        
                  </select>
                  <label>Category</label>
                </div>
                <div class="md-form">
                  <div class="file-field">
                    <div class="btn btn-primary btn-sm float-left" style="line-height: 2rem;"> <span>Select Thumbnail</span>
                      <input type="file" name="thumbnail" accept="image/x-png,image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload thumbnail image">
                    </div>
                  </div>
                  <small>only jpg, png files are allowed. Recommended 320x180 . Maximum file size {{config('app.max_thumbnail_upload_size')}}MB</small> </div>
                <div class="clearfix"></div>
                <div class="md-form" id="embed_code">
                  <textarea name="embed_code" class="form-control md-textarea" placeholder="For e.g, <iframe src=''></iframe>">{{Input::old('embed_code')}}</textarea>
                  <label>Embed Code</label>
                </div>
                <div class="md-form hidden" id="video_file">
                  <div class="file-field">
                    <div class="btn btn-primary btn-sm" style="line-height: 2rem;"> <span>Select Video File</span>
                      <input type="file" name="video_file" accept="video/webm,video/mp4">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload video file">
                    </div>
                  </div>
                  <small>only mp4, webm files are allowed. Maximum file size {{config('app.max_video_upload_size')}}MB</small> </div>
                <div class="md-form"> @php $selected = Input::old('published',1); @endphp
                  <select class="mdb-select dropdown-primary" name="published">
                    <option value="1" @if(1 == $selected) selected @endif>Yes</option>
                    <option value="0" @if(0 == $selected) selected @endif>No</option>
                  </select>
                  <label>Published</label>
                </div>
                <div class="md-form">
                  <textarea name="tags" class="form-control md-textarea" placeholder="separated by comma">{{Input::old('tags')}}</textarea>
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