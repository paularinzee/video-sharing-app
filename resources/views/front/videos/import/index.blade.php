@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
@stop

@section('after_scripts') 
<script type="text/javascript">
$('#yt_search').on('click', function(event) {
    event.preventDefault();
    $('#progressbar').removeClass('hidden');
    var q = $('#keyword').val();
    var c = $('#category').val();
    var p = $('#published').val();
    if(q.length > 5)
    {   
        $.ajax({
            url: '{{action("VideoController@importSearch")}}',
            type: 'POST',
            data: {q: q},
        })
        .done(function(data) {
            $('#progressbar').addClass('hidden');
            $('#response_html').html(data);
        });
        
    }
    else{
        $('#progressbar').addClass('hidden');
        toastr.info('Minimum keyword  length should be greater than 5.')
    }
}); 


$('#response_html').on('click', '.import_video', function(event) {
    event.preventDefault();
    $('#progressbar').removeClass('hidden');
    var vid = $(this).data('vid');
    var c = $('#category').val();
    var p = $('#published').val();

        $.ajax({
            url: '{{action("VideoController@importVideo")}}',
            type: 'POST',
            data: {vid: vid, c: c, p: p},
        })
        .done(function(data) {
            $('#progressbar').addClass('hidden');
            if(data != 'error'){
                toastr.success(data);
            }
            else{
                toastr.error('There was an error importing this video');
            }
        });    
});            
</script> 
@stop

@section('content')
<main>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item active">{{$page_title}}</li>
  </ol>
  <!--Main layout-->
  <div class="container" style="min-height: 500px;">
    <div class="row"> 
      
      <!--Main column-->
      <div class="col-lg-12"> 
        
        <!--First row-->
        <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-12">
            <div class="divider-new">
              <h2 class="h2-responsive">{{$page_title}} from youtube</h2>
            </div>
          </div>
        </div>
        <!--/.First row--> 
        <br>
        
        <!--Second row-->
        <div class="row">
          <div class="col-lg-12"> 
            
            <!--Grid row-->
            <div class="row"> 
              
              <!--Grid column-->
              <div class="col-md-3">
                <div class="md-form mb-0">
                  <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Word related to videos on youtube">
                  <label for="keyword" class="">Keyword</label>
                </div>
              </div>
              <!--Grid column--> 
              
              <!--Grid column-->
              <div class="col-md-3">
                <div class="md-form mb-0">
                  <select class="mdb-select dropdown-primary" id="category" name="category" required>
                    <option value="" disabled>Select category</option>
                    
                                            @foreach($categories as $category)
                                            
                    <option value="{{$category->id}}">{{$category->name}}</option>
                       
                                            @endforeach         
                                        
                  </select>
                  <label>Category</label>
                </div>
              </div>
              <!--Grid column--> 
              
              <!--Grid column-->
              <div class="col-md-2">
                <div class="md-form mb-0">
                  <select class="mdb-select dropdown-primary" name="published" id="published">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label>Published</label>
                </div>
              </div>
              <!--Grid column--> 
              
              <!--Grid column-->
              <div class="col-md-1">
                <div class="md-form mb-0">
                  <button class="btn btn-primary" id="yt_search">Search</button>
                </div>
              </div>
              <!--Grid column--> 
              
            </div>
            <!--Grid row-->
            
            <div class="progress md-progress primary-color-dark hidden" id="progressbar">
              <div class="indeterminate"></div>
            </div>
            <div class="row pt-2" id="response_html"></div>
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