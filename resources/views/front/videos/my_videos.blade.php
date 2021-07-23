@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
@stop

@section('content')
<style type="text/css">
     td,th{
        text-align: center;
     }
 </style>
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
        <div class="row">
          <div class="col-lg-12">
            <table class="table dtable">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Type</th>
                  <th>Views</th>
                  <th>Likes</th>
                  <th>Dislikes</th>
                  <th>Published</th>
                  <th>Approved</th>
                  <th>Uploaded at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
              @php $i=1; @endphp
              @foreach($videos as $video)
              <tr>
                <th scope="row">{{$i++}}</th>
                <td><a href="{{$video->url}}">{{$video->title}}</a></td>
                <td>@if(isset($video->category)){{$video->category->name}}@else Uncategorized @endif</td>
                <td>@if($video->type == 1) Uploaded Video @else Embeded Video @endif</td>
                <td>{{$video->views}}</td>
                <td>{{$video->likes->count()}}</td>
                <td>{{$video->dislikes->count()}}</td>
                <td>@if($video->published == 1) Yes @else No @endif</td>
                <td>@if($video->status == 1) Yes @else No @endif</td>
                <td>{{$video->created_at}}</td>
                <td><a class="blue-text" href="{{url('my-videos/'.$video->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> <a class="red-text" href="{{url('my-videos/'.$video->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></a></td>
              </tr>
              @endforeach
                </tbody>
              
            </table>
          </div>
        </div>
        <!--/.Second row--> 
        <br/>
      </div>
      <!--/.Main column-->
      
      <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="0.2s"> @if(config('app.ad') == 1)
        {!! html_entity_decode(config('app.ad4')) !!}
        @endif </div>
    </div>
  </div>
  <!--/.Main layout--> 
  
</main>
@stop 