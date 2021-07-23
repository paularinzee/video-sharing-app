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
  <div class="container"> 
    <!--Naked Form-->
    <div class="card-block"> 
      
      <!--Header-->
      <div class="text-center">
        <h3><i class="fa fa-envelope"></i> Write to us:</h3>
        <hr class="mt-2 mb-2">
      </div>
      <form method="post" action="">
        {{ csrf_field() }} 
        <!--Body-->
        <div class="md-form"> <i class="fa fa-user prefix"></i>
          <input type="text" id="form3" name="name" class="form-control">
          <label for="form3">Your name</label>
        </div>
        <div class="md-form"> <i class="fa fa-envelope prefix"></i>
          <input type="text" id="form2" name="email" class="form-control">
          <label for="form2">Your email</label>
        </div>
        <div class="md-form"> <i class="fa fa-pencil prefix"></i>
          <textarea type="text" id="form8" name="message" class="md-textarea"></textarea>
          <label for="form8">Message</label>
        </div>
        <div class="text-center"> @if (count($errors) > 0)
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
          <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>
          @endif
          <button class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
    <!--Naked Form--> 
  </div>
</main>
@stop