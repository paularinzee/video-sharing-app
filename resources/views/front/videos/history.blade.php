@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
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
          <!--First columnn-->
          <div class="col-lg-3" style="margin-bottom: 10px"> 
            <!--Card-->
            <div class="card wow fadeIn" data-wow-delay="0.2s"> 
              
              <!--Card image-->
              <div class="view overlay hm-black-strong"> <img src="{{$video->thumb}}" width="100%" height="215" alt="{{$video->title}}"> <a href="{{$video->url}}">
                <div class="mask text-center pattern-1"> <br/>
                  <h3 class="yellow-text darken-4">{{$video->title}}</h3>
                  <p class="cyan-text">@if(isset($video->category)){{$video->category->name}}@else Uncategorized @endif</p>
                </div>
                </a> </div>
              <!--/.Card image--> 
              
              <!--Card content-->
              <div class="card-block"> 
                <!--Title-->
                <h5 class="blue-text"><a href="{{$video->url}}">{{$video->title}}</a></h5>
                <!--Text-->
                <p> <small class="text-muted">{{$video->views}} views</small> <small class="text-muted pull-right"><a href="{{url('history/'.$video->id.'/remove')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Remove from history"><i class="fa fa-trash red-text"></i></a></small> </p>
              </div>
              <!--/.Card content--> 
              
            </div>
            <!--/.Card--> 
          </div>
          <!--First columnn--> 
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