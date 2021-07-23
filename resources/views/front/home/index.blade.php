@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}">
@stop

@section('content')
<main> 
  
  <!--Main layout-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="0.2s"> @if(config('app.ad') == 1)
        {!! html_entity_decode(config('app.ad3')) !!}
        @endif </div>
      @if(!Request::get('page')) 
      <!--Featured Videos-->
      <div class="col-lg-12"> 
        
        <!--First row-->
        <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-12">
            <div class="divider-new">
              <h2 class="h2-responsive">Featured</h2>
            </div>
          </div>
        </div>
        <!--/.First row--> 
        <br>
        
        <!--Second row-->
        <div class="row"> @forelse($fvideos as $video)
          @include('front.inc.video_card')
          @empty
          <div class="col-lg-12">
            <h3 class="text-center text-muted">No Results</h3>
          </div>
          @endforelse </div>
        <!--/.Second row--> 
        <br/>
      </div>
      <!--/.Featured Videos--> 
      
      <!--Trending Videos-->
      <div class="col-lg-12"> 
        
        <!--First row-->
        <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-12">
            <div class="divider-new">
              <h2 class="h2-responsive">Trending</h2>
            </div>
          </div>
        </div>
        <!--/.First row--> 
        <br>
        
        <!--Second row-->
        <div class="row"> @forelse($tvideos as $video)
          @include('front.inc.video_card')
          @empty
          <div class="col-lg-12">
            <h3 class="text-center text-muted">No Results</h3>
          </div>
          @endforelse </div>
        <!--/.Second row--> 
        <br/>
      </div>
      <!--/.Trending Videos--> 
      @endif 
      
      <!--Recent Videos-->
      <div class="col-lg-12"> 
        
        <!--First row-->
        <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-12">
            <div class="divider-new">
              <h2 class="h2-responsive">New Videos</h2>
            </div>
          </div>
        </div>
        <!--/.First row--> 
        <br>
        
        <!--Second row-->
        <div class="row"> @forelse($videos as $video)
          @include('front.inc.video_card')
          @empty
          <div class="col-lg-12">
            <h3 class="text-center text-muted">No Results</h3>
          </div>
          @endforelse </div>
        <!--/.Second row--> 
        <br/>
      </div>
      <!--/. Recent Videos-->
      
      <div class="text-center pagination-container">{{$videos->appends(request()->input())->links()}}</div>
      <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="0.2s"> @if(config('app.ad') == 1)
        {!! html_entity_decode(config('app.ad4')) !!}
        @endif </div>
    </div>
  </div>
  <!--/.Main layout--> 
  
</main>
@stop 