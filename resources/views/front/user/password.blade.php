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
  <div class="container"> 
    <!--Naked Form-->
    <div class="card-block"> 
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">    
 <!--Header-->
 <div class="text-center">
  <h3>{{$page_title}}</h3>
  <hr class="mt-2 mb-2">
</div>

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
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>{{session('success')}}</div>
@endif

<form method="post" action="">
  {{ csrf_field() }} 
  <!--Body-->
  <div class="md-form">
    <input type="password" id="form3" name="current_password" class="form-control">
    <label for="form3">Current password</label>
  </div>
  <div class="md-form">
    <input type="password" id="form4" name="password" class="form-control">
    <label for="form4">New password</label>
  </div>
  <div class="md-form">
    <input type="password" id="form5" name="password_confirmation" class="form-control">
    <label for="form5">Repeat password</label>
  </div>
  <div class="text-center"> 
    <button class="btn btn-default">Submit</button>
  </div>
</form>


        </div>
      </div>
     


    </div>
    <!--Naked Form--> 
  </div>
</main>
@stop