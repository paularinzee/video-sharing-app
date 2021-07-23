@extends('admin.layouts.default')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Settings </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li class="active">Settings</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Settings</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools --> 
      </div>
      <!-- /.box-header -->
      <div class="box-body pad "> @if ($errors->any())
        <div class="form-group">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! implode('', $errors->all('
            <li>:message</li>
            ')) !!} </div>
        </div>
        @endif
        
        @if(session('success'))
        <div class="form-group">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('success')}} </div>
        </div>
        @endif
        <form role="form" method="post" action="" enctype="multipart/form-data">
          {{ csrf_field() }}
          <h4 class="text-center"><i class="fa fa-cog"></i> General <i class="fa fa-cog"></i></h4>

          <div class="row">
               <div class="form-group col-md-6">
            <label>Site Name</label>
            <input class="form-control" name="site_name" placeholder="Imgshr" value="{{ $site_name }}">
          </div>
          <div class="form-group col-md-6">
            <label>Site Email</label>
            <input class="form-control" placeholder="Email address" name="site_email" value="{{ $site_email }}">
          </div>       

          </div>


          <div class="form-group">
            <label>Site Logo</label>
            <img src="{{$site_logo}}" class="img-responsive" style="height: 80px;">
            <input type="file" class="form-control" name="site_logo" accept="image/png" value="">
          </div>

          <div class="row">
                      
          <div class="form-group col-md-6">
            <label>Site Skin</label>
            @php
            $skins = explode(',',$skins);
            $selected = old('skin',$skin);
            @endphp
            <select name="skin" class="form-control">
              
            @foreach($skins as $skin)
              
              <option value="{{$skin}}" @if($selected == $skin) selected @endif>{{ucwords(str_replace('-',' ',$skin))}}</option>
              
            @endforeach
              
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Videos Per Page</label>
            <input type="number" class="form-control" name="videos_per_page" placeholder="20" value="{{ $videos_per_page }}">
          </div>

          </div>

          <div class="form-group">
            <label>Footer Text</label>
            <textarea class="form-control" placeholder="Footer Text" name="footer_text">{{ $footer_text }}</textarea>
          </div>
          <h4 class="text-center"><i class="fa fa-cog"></i> SEO <i class="fa fa-cog"></i></h4>
          <div class="form-group">
            <label>Meta Description</label>
            <textarea class="form-control" placeholder="Meta description" name="meta_description">{{ $meta_description }}</textarea>
          </div>
          <div class="form-group">
            <label>Meta Keywords</label>
            <textarea class="form-control" placeholder="Meta keywords" name="meta_keywords">{{ $meta_keywords }}</textarea>
          </div>
          <div class="form-group">
            <label>Google Analytics Code</label>
            <textarea class="form-control" name="google_analytics" placeholder="<script>..</script>">{!! html_entity_decode($google_analytics) !!}</textarea>
          </div>

          <h4 class="text-center"><i class="fa fa-cog"></i> Upload & Import <i class="fa fa-cog"></i></h4>


          <div class="row">
            
          <div class="form-group col-md-6">
            <label>Max Video Upload Size (in MB)</label>
            <input type="number" class="form-control" name="max_video_upload_size" placeholder="1" value="{{ $max_video_upload_size }}">
          </div>
          <div class="form-group col-md-6">
            <label>Max Thumbnail Upload Size (in MB)</label>
            <input type="number" class="form-control" name="max_thumbnail_upload_size" placeholder="1" value="{{ $max_thumbnail_upload_size }}">
          </div>

          </div>



          <div class="form-group">
            <label>YouTube Data API V3 API KEY</label>
            <input class="form-control" name="youtube_api_key" placeholder="1" value="{{ $youtube_api_key }}">
            <small><a href="https://console.developers.google.com/" target="_blank">Obtain API key from Google API Console</a></small> </div>
          
          <div class="form-group">
            <label>User Upload</label>
            <label class="radio-inline">
              <input type="radio" name="user_upload" id="user_upload1" value="1" @if($user_upload == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="user_upload" id="user_upload0" value="0" @if($user_upload == 0) checked @endif>
              Off </label>
          </div>

          <div class="form-group">
            <label>User Embed</label>
            <label class="radio-inline">
              <input type="radio" name="user_embed" id="user_embed1" value="1" @if($user_embed == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="user_embed" id="user_embed0" value="0" @if($user_embed == 0) checked @endif>
              Off </label>
          </div>

          <div class="form-group">
            <label>User Video Import</label>
            <label class="radio-inline">
              <input type="radio" name="user_import" id="user_import1" value="1" @if($user_import == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="user_import" id="user_import0" value="0" @if($user_import == 0) checked @endif>
              Off </label>
          </div>
          <div class="form-group">
            <label>Video Download</label>
            <label class="radio-inline">
              <input type="radio" name="video_download" id="video_download1" value="1" @if($video_download == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="video_download" id="video_download0" value="0" @if($video_download == 0) checked @endif>
              Off </label>
              <small>This option will enable/disable video download button for uploaded videos. Note - It can not prevent download of video</small>
          </div>

          <div class="form-group">
            <label>Auto Approve Videos</label>
            <label class="radio-inline">
              <input type="radio" name="auto_approve" id="optionsRadiosInline4" value="1" @if($auto_approve == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="auto_approve" id="optionsRadiosInline5" value="0" @if($auto_approve == 0) checked @endif>
              Off </label>
          </div>          

          <h4 class="text-center"><i class="fa fa-cog"></i> Comments <i class="fa fa-cog"></i></h4>
          <div class="form-group">
            <label>Comments </label>
            <label class="radio-inline">
              <input type="radio" name="comments" id="optionsRadiosInline7" value="1" @if($comments == 1) checked @endif>
              Custom Comments </label>
            <label class="radio-inline">
              <input type="radio" name="comments" id="optionsRadiosInline8" value="2" @if($comments == 2) checked @endif>
              Disqus Comments </label>
            <label class="radio-inline">
              <input type="radio" name="comments" id="optionsRadiosInline9" value="0" @if($comments == 0) checked @endif>
              Off </label>
          </div>
          <div class="form-group">
            <label>Disqus Code</label>
            <textarea class="form-control" rows="3" name="disqus_code">{!! html_entity_decode($disqus_code) !!}</textarea>
          </div>

          <h4 class="text-center"><i class="fa fa-cog"></i> Advertisement <i class="fa fa-cog"></i></h4>
          <div class="form-group">
            <label>AdBlocks (on/off)</label>
            <label class="radio-inline">
              <input type="radio" name="ad" id="optionsRadiosInline1" value="1" @if($ad == 1) checked @endif>
              On </label>
            <label class="radio-inline">
              <input type="radio" name="ad" id="optionsRadiosInline2" value="0" @if($ad == 0) checked @endif>
              Off </label>
          </div>


          <div class="row">
            
          <div class="form-group col-md-6">
            <label>AdBlock 1</label>
            <textarea class="form-control" name="ad1" rows="3">{!! html_entity_decode($ad1) !!}</textarea>
          </div>
          <div class="form-group col-md-6">
            <label>AdBlock 2</label>
            <textarea class="form-control" name="ad2" rows="3">{!! html_entity_decode($ad2) !!}</textarea>
          </div>

          </div>
          <div class="row">
         
          <div class="form-group col-md-6">
            <label>AdBlock 3</label>
            <textarea class="form-control" name="ad3" rows="3">{!! html_entity_decode($ad3) !!}</textarea>
          </div>
          <div class="form-group col-md-6">
            <label>AdBlock 4</label>
            <textarea class="form-control" name="ad4" rows="3">{!! html_entity_decode($ad4) !!}</textarea>
          </div>   

          </div>

          <div class="row">
            
          <div class="form-group col-md-6">
            <label>VAST Ad 1</label>
            <input class="form-control" name="vast_ad1" placeholder="VAST Ad link" value="{{ $vast_ad1 }}">
          </div>
          <div class="form-group col-md-6">
            <label>VAST Ad 2</label>
            <input class="form-control" name="vast_ad2" placeholder="VAST Ad link" value="{{ $vast_ad2 }}">
          </div> 
          </div>


          <h4 class="text-center"><i class="fa fa-cog"></i> Mail <i class="fa fa-cog"></i></h4>

          <div class="row">
            
            <div class="form-group col-md-6">
              <label>Driver</label>
              @php $selected = old('mail_driver',$mail_driver); @endphp
              <select name="mail_driver" class="form-control">
                <option value="mail" {{ $selected == 'mail' ? 'selected' : '' }}>PHP Mail (PHP Default Mailer)</option>
                <option value="smtp" {{ $selected == 'smtp' ? 'selected' : '' }}>SMTP</option>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label>Host</label>
              <input class="form-control" type="text" name="mail_host" value="{{ old('mail_host',$mail_host) }}">
            </div>

          </div>

          <div class="row">
            
            <div class="form-group col-md-6">
              <label>Username</label>
              <input class="form-control" type="text" name="mail_username" value="{{ old('mail_username',$mail_username) }}">
            </div>            
            <div class="form-group col-md-6">
              <label>Password</label>
              <input class="form-control" type="password" name="mail_password" value="{{ old('mail_password',$mail_password) }}">
            </div>

          </div>

          <div class="row">
            
            <div class="form-group col-md-6">
              <label>Port</label>
              <input class="form-control" type="text" name="mail_port" value="{{ old('mail_port',$mail_port) }}">
            </div>            
            <div class="form-group col-md-6">
              <label>Encryption</label>
              @php $selected = old('mail_encryption',$mail_encryption); @endphp
              <select class="form-control" name="mail_encryption">
                  <option value="tls" {{ ($selected == 'tls') ? 'selected' : '' }}>tls</option>
                  <option value="ssl" {{ ($selected == 'ssl') ? 'selected' : '' }}>ssl</option>
              </select>
            </div>

          </div>

          <div class="row">
            
            <div class="form-group col-md-6">
              <label>From Name</label>
              <input class="form-control" type="text" name="mail_from_name" value="{{ old('mail_from_name',$mail_from_name) }}">
            </div>            
            <div class="form-group col-md-6">
              <label>From Address</label>
              <input class="form-control" type="email" name="mail_from_address" value="{{ old('mail_from_address',$mail_from_address) }}">
            </div>

          </div>


          <h4 class="text-center"><i class="fa fa-cog"></i> Social Links <i class="fa fa-cog"></i></h4>

          <div class="row">
                      <div class="form-group col-md-6">
            <label>Facebook Link</label>
            <input class="form-control" name="social_fb" placeholder="https://facebook.com/username" value="{{ $social_fb }}">
          </div>
          <div class="form-group col-md-6">
            <label>Google Plus Link</label>
            <input class="form-control" name="social_gplus" placeholder="https://plus.google.com/username" value="{{ $social_gplus }}">
          </div>
          </div>
          <div class="row">
            
          <div class="form-group col-md-6">
            <label>Twitter Link</label>
            <input class="form-control" name="social_twitter" placeholder="https://twitter.com/@username" value="{{ $social_twitter }}">
          </div>
          <div class="form-group col-md-6">
            <label>Pinterest Link</label>
            <input class="form-control" name="social_pinterest" placeholder="https://pinterest.com/username" value="{{ $social_pinterest }}">
          </div>
          </div>






          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop 