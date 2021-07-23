
<div class="col-lg-3 col-sm-6" style="margin-bottom: 10px"> 
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
      <p> <small class="text-muted pull-left">{{$video->views}} views</small> <small class="text-muted pull-right">{{$video->created_at->diffForHumans()}}</small> </p>
    </div>
    <!--/.Card content--> 
    
  </div>
  <!--/.Card--> 
</div>
