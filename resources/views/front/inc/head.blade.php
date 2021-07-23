<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta')
<meta name="author" content="{{url('/')}}">
<title>@if(isset($page_title)){{$page_title.' - '}}@endif {{ config('app.site_name') }} </title>
<link rel="shortcut icon" href="{{url('favicon.png')}}" />
@yield('before_styles') 
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<!-- Bootstrap core CSS --> 
<!-- <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">--> 
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />

<!-- Material Design Bootstrap -->
<link href="{{url('css/compiled.min.css')}}" rel="stylesheet" />
<link href="{{url('css/style.css')}}" rel="stylesheet" />
@yield('after_styles')

{!! html_entity_decode(config('app.google_analytics')) !!}