<!DOCTYPE html>
<html>
<head>
<title>{{$page_title}} - {{config('app.site_name')}}</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
</head>
<body>
<div class="embed-responsive embed-responsive-16by9" style="background-color: black;">
  <div id="player-wrapper" class="embed-responsive-item">

    @if($video->type == 1)
      <iframe src="{{url('watch/'.$video->id.'/'.$video->slug)}}" allowfullscreen scrolling="no" frameBorder="0" height="100%"></iframe>
    @else
      {!!$video->content!!}
    @endif

  </div>
</div>

</body>
</html>