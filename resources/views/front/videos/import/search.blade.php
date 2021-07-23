@foreach($videos as $video)
<div class="col-lg-3 col-sm-6" style="margin-bottom: 10px"> 
  <!--Card-->
  <div class="card wow fadeIn" data-wow-delay="0.2s"> 
    
    <!--Card image-->
    <div class="view overlay hm-black-strong"> <img src="{{$video->snippet->thumbnails->medium->url}}" width="100%" alt="{{$video->snippet->title}}"> <a href="#">
      <div class="mask text-center pattern-1"> <br/>
        <h3 class="yellow-text darken-4">{{$video->snippet->title}}</h3>
        <p class="cyan-text">{{$video->snippet->channelTitle}}</p>
      </div>
      </a> </div>
    <!--/.Card image--> 
    
    <!--Card content-->
    <div class="card-block"> 
      <!--Title-->
      <h5 class="blue-text"><a href="https://www.youtube.com/watch?v={{$video->id->videoId}}" target="_blank">{{$video->snippet->title}}</a></h5>
      <!--Text-->
      <p> <small class="text-muted pull-left"><a href="https://www.youtube.com/channel/{{$video->snippet->channelId}}" target="_blank">{{$video->snippet->channelTitle}}</a></small> <small class="text-muted pull-right"><a title="Import" class="import_video" data-vid="{{$video->id->videoId}}"><i class="fa fa-download green-text"></i></a></small> </p>
    </div>
    <!--/.Card content--> 
    
  </div>
  <!--/.Card--> 
</div>
@endforeach