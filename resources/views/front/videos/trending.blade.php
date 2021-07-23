@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
@stop

@section('content')
<main>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item active">Trending</li>
  </ol>
  <!--Main layout-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="0.2s"> @if(config('app.ad') == 1)
        {!! html_entity_decode(config('app.ad3')) !!}
        @endif </div>
      
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
      <!--/.Main column-->
      
      <div class="text-center pagination-container">{{$videos->links()}}</div>
      <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="0.2s"> @if(config('app.ad') == 1)
        {!! html_entity_decode(config('app.ad4')) !!}
        @endif </div>
    </div>
  </div>
  <!--/.Main layout--> 
  
</main>
@stop 