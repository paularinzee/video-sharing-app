@extends('front.layouts.default')

@section('meta')
<meta name="description" content="{{str_limit($video->description,255,'')}}">
<meta name="keywords" content="{{str_limit($video->tags,255,'')}}">
@stop

@section('after_styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
<link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">
@stop

@section('after_scripts') 
<script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script> 
<script type="text/javascript">
$(document).ready(function(){
    $("#showComment").trigger("click");
});  

$(".watch_later").on('click', function(event) {
    event.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: '{{action("VideoController@addWatchLater")}}',
        type: 'POST',
        data: {id: id},
    })
    .done(function(data) {
        toastr.success(data);
    });
    
});

function copyToClip(str, response_field = '') {
    function listener(e) {
        e.clipboardData.setData("text/html", str);
        e.clipboardData.setData("text/plain", str);
        e.preventDefault();
    }

    document.addEventListener("copy", listener);
    document.execCommand("copy");
    document.removeEventListener("copy", listener);
    if (response_field.length > 0) $('#' + response_field).html('Copied');
}

</script> 
@stop
@section('content')   


@php
    $page_url = $video->url;
@endphp
    <main>
  <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url($video->category->slug)}}">{{$video->category->name}}</a></li>
        <li class="breadcrumb-item active">{{$video->title}}</li>
      </ol>
  
  <!--Main layout-->
  <div class="container">
        <div class="row"> 
      
      <!--Main column-->
      <div class="col-lg-12"> 
            
            <!--First row-->
            <div class="row wow fadeIn" data-wow-delay="0.4s">
          <div class="col-lg-9">
                 @if(config('app.ad') == 1) <div class="text-center  mt-2 mb-2">
              {!! html_entity_decode(config('app.ad1')) !!} </div>
              @endif 
                <div class="divider-new" style="margin-bottom: 0px">
              <h2 class="h2-responsive">{{$video->title}}</h2>
            </div>
              </div>
        </div>
            <!--/.First row--> 
            <br>
            
            <!--Second row-->
            <div class="row">
          <div class="col-lg-9"> 
            @if($video->type == 1)
                <div class="embed-responsive embed-responsive-16by9" >
              <iframe src="{{url('watch/'.$video->id.'/'.$video->slug)}}" allowfullscreen scrolling="no" frameBorder="0" height="100%"></iframe>
            </div>
             @else
                <div class="embed-responsive embed-responsive-16by9" > {!!$video->content!!} </div>
              @endif 

              <br/>
                <h4 data-id="{{$video->id}}" class="pull-left watch_later" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Add to watch later"> <i class="fa fa-plus"></i>&nbsp;Add to&nbsp; </h4>

                <h4 class="pull-left" style="cursor: pointer;" data-toggle="modal" data-target="#shareModal">
                  <i class="fa fa-share"></i>&nbsp; Share&nbsp;
                </h4>               

                @if($video->type == 1 && config('app.video_download') == 1)
                <a class="text-success" href="{{url($video->content)}}" download>
                  <h4 class="pull-left" style="cursor: pointer;"><i class="fa fa-download"></i>&nbsp; Download&nbsp;</h4>
                </a>
                @endif

                <h3 class="pull-right text-muted"><b>{{number_format($video->views)}} views</b></h3>
                <br/>
                <br/>
                <div class="pull-right"> @include('laravelLikeComment::like', ['like_item_id' => $video->id])
              <p class="pull-right" style="cursor: pointer;" data-toggle="modal" data-target="#reportModal"><i class="fa fa-flag"></i>&nbsp; Report</p>
            </div>
                @if(isset($video->user))
                <div> <img src="{{$video->user->avatar}}" class="rounded-circle avatar z-depth-1-half mb-1 pull-left" style="height: 50px;"> <span class="ml-3"><b>{{$video->user->name}}</b><br/>
                  <span class="text-muted ml-3 small">{{$video->created_ago}}</span> </span> </div>
                @endif
                <div class="clearfix"></div>
                @if(!empty($video->description))
                <div>
              <p class="text-muted">Description</p>
              <p>{!! html_entity_decode($video->description) !!}</p>
            </div>
                @endif <br/>
                @if(config('app.comments') == 1)
                @include('laravelLikeComment::comment', ['comment_item_id' => $video->id])
                @elseif(config('app.comments') == 2)
                {!! html_entity_decode(config('app.disqus_code')) !!}
                @endif
                
                  @if(config('app.ad') == 1) 
                    <div class="text-center mt-2 mb-2"> 
                      {!! html_entity_decode(config('app.ad2')) !!}
                    </div>
                  @endif 
                
              </div>
          <div class="col-md-3">
                <div>
              <p class="text-muted ml-3"><b>Similar Videos</b></p>
            </div>
                @forelse($svideos as $svideo) 
                <!--First columnn-->
                <div class="col-md-10" style="margin-bottom: 10px"> 
              <!--Card-->
              <div class="card wow fadeIn" data-wow-delay="0.2s"> 
                    
                    <!--Card image-->
                    <div class="view overlay hm-black-strong"> <img class="img-responsive" src="{{$svideo->thumb}}" width="100%" alt="{{$video->title}}"> <a href="{{$svideo->url}}">
                      <div class="mask text-center pattern-1"> <br/>
                      <h5 class="yellow-text darken-4">{{$svideo->title}}</h5>
                      <p class="cyan-text">@if(isset($svideo->category)){{$svideo->category->name}}@else Uncategorized @endif</p>
                    </div>
                      </a> </div>
                    <!--/.Card image--> 
                    
                  </div>
              <!--/.Card--> 
            </div>
                <!--First columnn--> 
                @empty
                <div class="col-lg-12">
              <h5 class="text-center text-muted">No similar videos available</h5>
            </div>
                @endforelse </div>
        </div>
            
            <!--/.Second row--> 
            
          </div>
      <!--/.Main column--> 
      
    </div>
      </div>
  <!--/.Main layout--> 
  
</main>

    <!-- Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document"> 
        <!--Content-->
        <div class="modal-content"> 
      <!--Header-->
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            <h4 class="modal-title w-100" id="myModalLabel"><i class="fa fa-share"></i> Share</h4>
          </div>
      <!--Body-->
      <div class="modal-body text-center"> 

        <a href="#" onclick="MyWindow=window.open('https://www.facebook.com/dialog/share?app_id=1932129293685911&amp;display=popup&amp;href={{$page_url}}','Facebook share','width=600,height=300'); return false;" class="btn btn-fb btn-sm waves-effect waves-light"><i class="fa fa-facebook"></i></a> 
        <a href="#" onclick="MyWindow=window.open('https://twitter.com/share?url={{$page_url}}','Twitt this','width=600,height=300'); return false;" class="btn btn-tw btn-sm waves-effect waves-light"><i class="fa fa-twitter"></i></a> 
        <a href="#" onclick="MyWindow=window.open('https://plus.google.com/share?url={{$page_url}}','Google Plus share','width=600,height=300'); return false;" class="btn btn-gplus btn-sm waves-effect waves-light"><i class="fa fa-google-plus"></i></a> 

        <div class="md-form mt-2">
          <label><i class="fa fa-code"></i> Embed Code</label>
          <textarea id="embed_code" rows="3" class="md-textarea"><iframe width="560" height="315" src="{{ route('video.embed',['id'=>$video->id,'slug'=>$video->slug]) }}" scrolling="no" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></textarea>
        </div>
        <span id="embed_response" class="text-success"></span><br/>

          <button class="btn btn-info btn-sm" onclick="copyToClip(document.getElementById('embed_code').value,'embed_response')"> <i class="fa fa-copy"></i> Copy</button>

      </div>
      <!--Footer-->
      <div class="modal-footer"> </div>
    </div>
        <!--/.Content--> 
      </div>
</div>
    <!-- Modal --> 

    <!-- Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document"> 
        <!--Content-->
        <div class="modal-content"> 
      <!--Header-->
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            <h4 class="modal-title w-100" id="myModalLabel"><i class="fa fa-share"></i> Report Video</h4>
          </div>
      <form method="post" action="{{action('VideoController@reportVideo')}}">
            <!--Body-->
            <div class="modal-body"> {{csrf_field()}}
          <input type="hidden" name="id" value="{{$video->id}}">
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Sexual Content" id="radio1">
                <label class="form-check-label" for="radio1">Sexual Content</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Violent or repulsive content" id="radio2">
                <label class="form-check-label" for="radio2">Violent or repulsive content</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Hateful or abusive content" id="radio3">
                <label class="form-check-label" for="radio3">Hateful or abusive content</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Harmful dangerous acts" id="radio4">
                <label class="form-check-label" for="radio4">Harmful dangerous acts</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Child abuse" id="radio5">
                <label class="form-check-label" for="radio5">Child abuse</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Promotes terrorism" id="radio6">
                <label class="form-check-label" for="radio6">Promotes terrorism</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Spam or misleading" id="radio7">
                <label class="form-check-label" for="radio7">Spam or misleading</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Infringes my rights" id="radio8">
                <label class="form-check-label" for="radio8">Infringes my rights</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Captions issue" id="radio9">
                <label class="form-check-label" for="radio9">Captions issue</label>
              </div>
          <div class="form-check">
                <input type="radio" class="form-check-input" name="reason" value="Not Working" id="radio10">
                <label class="form-check-label" for="radio10">Not Working</label>
              </div>
        </div>
            <!--Footer-->
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
          </form>
    </div>
        <!--/.Content--> 
      </div>
</div>
    <!-- Modal --> 

    @stop 