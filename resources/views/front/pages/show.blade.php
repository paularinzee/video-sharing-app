@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{config('app.meta_description')}}">
<meta name="keywords" content="{{config('app.meta_keywords')}}, {{$page_title}}">
@stop


@section('content')
<main>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item active">{{$page_title}}</li>
  </ol>
  
  <!-- Page Content -->
  <div class="container"> <br/>
    <h1>{{$page_title}}</h1>
    @php echo html_entity_decode($page->content); @endphp </div>
  <!-- /.container --> 
</main>
@stop