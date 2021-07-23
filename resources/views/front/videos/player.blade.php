<!DOCTYPE html>
<html>
<head>
<title>{{$page_title}} - {{config('app.site_name')}}</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
<!-- Video.js 5 -->
<!-- <link href="http://vjs.zencdn.net/5.4.6/video-js.css" rel="stylesheet"> -->
<link href="//vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">

<!-- Common -->
<link href="{{url('bin/videojs.vast.vpaid.min.css')}}" rel="stylesheet">
<link href="{{url('css/vjs-skin.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="embed-responsive embed-responsive-16by9" style="background-color: black;">
  <div id="player-wrapper" class="embed-responsive-item">
    <video id="video_1" class="video-js vjs-big-play-centered" style="height: 100%;width: 100%"  
    controls preload="auto"
    poster="{{$video->thumb}}"
    data-setup='{"playbackRates": [1, 1.5, 2],
@if(!empty($vast_ad))      "plugins": {
      "vastClient": {
        "adTagUrl": "{{$vast_ad}}",
        "adsCancelTimeout": 5000,
        "adsEnabled": true
        }
      } @endif
    }'>
      <source src="{{url($video->content)}}" type='video/mp4'/>
      <p class="vjs-no-js"> To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a> </p>
    </video>
  </div>
</div>

<!-- Video.js 5 --> 
<!--<script src="http://vjs.zencdn.net/5.4.6/video.js"></script> --> 
<script src="//vjs.zencdn.net/6.6.3/video.js"></script> 
<script src="{{url('bin/videojs_5.vast.vpaid.min.js')}}"></script> 
<script src="{{url('bin/ie8fix.js')}}"></script> 
<script type="text/javascript">
var video = videojs('video_1');  
</script>
</body>
</html>