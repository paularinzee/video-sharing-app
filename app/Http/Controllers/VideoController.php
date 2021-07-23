<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Video;
use App\Category;
use App\Report;
use risul\LaravelLikeComment\Models\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App;
use Input;
use Hash;
use Mail;
use Image;
use Youtube;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class VideoController extends Controller
{

 	public function show($id,$slug)
    {
    	if(Auth::check())
    	{
    		if(Auth::user()->role == 1)
    		{
				$video = Video::where('id',$id)->firstOrfail();
    		}
    		else{
    			$video = Video::where('id',$id)->where('status',1)->where('published',1)->firstOrfail();
    		}
        	
    	}
    	else{
    		$video = Video::where('id',$id)->where('status',1)->where('published',1)->firstOrfail();
    	}


        $svideos = Video::where('id','!=',$video->id)->where('status',1)->where('published',1)->where('category_id',$video->category_id)->inRandomOrder()->take(6)->get();  

        if(Auth::check()){
            $user = Auth::user();
            $views = explode(',', $user->views);

            if(!in_array($video->id, $views)){
                array_push($views, $video->id);
                $user->views = implode(',', $views);                
            }

            $history = explode(',', $user->history);
            $pos = array_search($video->id, $history);            
            if($pos !== false){
                unset($history[$pos]);
            }
            array_push($history, $video->id);
            $user->history = implode(',', $history);
            $user->save();
            
        }

        if (session()->has('already_viewed')) {
            $already_viewed = session('already_viewed');

            if (!in_array($video->id, $already_viewed)) {
                array_push($already_viewed, $video->id);
                $video->views = $video->views + 1;
                $video->save();
            }

            session(['already_viewed' => $already_viewed]);
        } else {
            $already_viewed = [$video->id];
            session(['already_viewed' => $already_viewed]);
            $video->views = $video->views + 1;
            $video->save();
        }        

        return view('front.videos.show',['video' => $video, 'svideos' => $svideos])->with('page_title',$video->title);
    }


    public function ajaxSearch()
    {        
        $validator = Validator::make(Input::all(), [
            'term' => 'string',
        ]); 
        if ($validator->fails()) {    
            echo "error";
        }
        else{
            $term = Input::get('term');
            $terms = explode(' ', $term);

            $videos = Video::where('status',1)->where('published',1)->where(function($query) use ($term,$terms){
                $query->orWhere('title','like','%'.$term.'%');
                foreach ($terms as $t) {
                    $query->orWhere('title','like','%'.$t.'%');
                }
            })->orderBy('title')->take(12)->pluck('title')->toArray();


           return $videos;
        }
    }



	public function trending()
    {
        $data['videos'] = Video::where('status',1)->where('published',1)->orderBy('views','DESC')->paginate(config('app.videos_per_page'));
        return view('front.videos.trending',$data)->with('page_title','Trending');
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keyword' => 'max:150|string',
        ]);
       if ($validator->fails()) {
            abort(404);
        }
        else { 

            $keyword = Input::get('keyword');

            $data['videos'] = Video::where('status',1)->where('published',1)->where('title','like','%'.$keyword.'%')->orderBy('created_at','DESC')->paginate(config('app.videos_per_page'));

            return view('front.videos.search',$data)->with('page_title','Search Result');
        }

    }

    public function history()
    {
        $user = Auth::user();
        $history = explode(',', $user->history);

        $placeholders = implode(',',array_fill(0, count($history), '?'));

        $data['videos'] = Video::whereIn('id',$history)->where('status',1)->where('published',1)->orderByRaw("field(id,{$placeholders}) DESC", $history)->paginate(config('app.videos_per_page'));

        return view('front.videos.history',$data)->with('page_title','History');
    }

    public function likedVideos()
    {
        $likes = Like::where('user_id',Auth::user()->id)->where('vote',1)->where('item_id','not like','comment-%')->pluck('item_id')->toArray();
       
        $placeholders = implode(',',array_fill(0, count($likes), '?'));

        $videos = Video::where('status',1)->where('published',1)->whereIn('id',$likes)->orderByRaw("field(id,{$placeholders}) DESC", $likes)->paginate(config('app.videos_per_page'));

        return view('front.videos.liked_videos',compact('videos'))->with('page_title','Liked Videos');
    }    

    public function watchLater()
    {
        $user = Auth::user();
        $watch_later = explode(',', $user->watch_later);

        $placeholders = implode(',',array_fill(0, count($watch_later), '?'));

        $data['videos'] = Video::where('status',1)->where('published',1)->whereIn('id',$watch_later)->orderByRaw("field(id,{$placeholders}) DESC", $watch_later)->paginate(config('app.videos_per_page'));

        return view('front.videos.watch_later',$data)->with('page_title','Saved Videos');
    } 

    public function removeHistory($id)
    {
            $user = Auth::user();
            $history = explode(',', $user->history);

            if(in_array($id, $history))
            {
                $pos = array_search($id, $history);            
                if($pos !== false){
                    unset($history[$pos]);

                    $user->history = implode(',', $history);
                    $user->save();
                }
            }
        return redirect()->back()->withSuccess('Video successfully removed from history.');

    }

    public function removeLikedVideo($id)
    {
    	Like::where('user_id',Auth::user()->id)->where('item_id',$id)->delete();
        return redirect()->back()->withSuccess('Video successfully removed from Liked Videos.');

    }    

    public function removeWatchLater($id)
    {
            $user = Auth::user();
            $watch_later = explode(',', $user->watch_later);

            if(in_array($id, $watch_later))
            {
                $pos = array_search($id, $watch_later);            
                if($pos !== false){
                    unset($watch_later[$pos]);

                    $user->watch_later = implode(',', $watch_later);
                    $user->save();
                }
            }
        return redirect()->back()->withSuccess('Video successfully removed from saved videos.');

    }    

    public function addWatchLater(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $watch_later = explode(',', $user->watch_later);

        if(!in_array($id, $watch_later)){
            array_push($watch_later, $id);
            $user->watch_later = implode(',', $watch_later);
            $user->save();
            echo "Video successfully added to watch later videos list.";
        }
        else {
            echo "Video already exists in watch later videos list.";
        }

    }

	public function showUpload()
    {
        if(config('app.user_upload') != 1 && config('app.user_embed') != 1 && \Auth::user()->role != 1) return redirect()->back()->withErrors(__('User upload & embed is disabled'));
        $data['categories'] = Category::orderBy('name')->get();
        return view('front.videos.upload')->with('page_title','Upload Video');        
    }

    public function upload(Request $request)
    {  
    	if($request->type == 1)
    	{	
            if(config('app.user_upload') != 1 && \Auth::user()->role != 1) return redirect()->back()->withErrors(__('User upload is disabled'));
    		$max_video_upload_size = config('app.max_video_upload_size') * 1024;
    		$max_thumbnail_upload_size = config('app.max_thumbnail_upload_size') * 1024;

	       	$validator = Validator::make($request->all(), [
	            'type' => 'required|numeric|in:1,2',
	            'title' => 'required|min:5|max:100',
	            'description' => 'max:9000',
	            'tags' => 'max:500',
	            'category_id' => 'required|numeric|exists:categories,id',
	            'published' => 'required|numeric|in:0,1',
	            'thumbnail' => 'mimes:jpeg,png|max:'.$max_thumbnail_upload_size,
	            'video_file' => 'required|mimetypes:video/mp4,video/webm|max:'.$max_video_upload_size
	        ]);
	       	if ($validator->fails()) 
	       	{
	            return redirect()->back()->withErrors($validator)->withInput();
	        }
	        $video = new Video();
	        $file = $request->file('video_file');
	        $file_ext = $file->getClientOriginalExtension();
	        $destinationPath = 'uploads/'.date('Y').'/'.date('m').'/'.date('d');
	        if(!file_exists($destinationPath)){
	        	mkdir($destinationPath,0755,true);
	        }
	        $random = str_random(10); 

	        $new_file_name = $random.'.'.$file_ext;
 			$file->move($destinationPath,$new_file_name);

	        if($request->hasFile('thumbnail'))
	        {
                if(!empty($video->thumbnail)){
                    @unlink(ltrim($video->thumbnail,'/'));
                }

	        	$thumbnail = $request->file('thumbnail');
	        	$file_ext = $thumbnail->getClientOriginalExtension();
	        	$thumbnail_name = $random.'.'.$file_ext;
	        	$resized_thumbnail_name = $random.'_320x180.'.$file_ext;

	        	$thumbnail->move($destinationPath,$thumbnail_name);
	        	$original_thumbnail = $destinationPath.'/'.$thumbnail_name;

	        	Image::make($original_thumbnail)->resize(320, 180)->save($destinationPath.'/'.$resized_thumbnail_name);

	        	$video->thumbnail = '/'.$destinationPath.'/'.$resized_thumbnail_name;
	        	@unlink($original_thumbnail);
	        }

            $video->type  = 1;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->tags = $request->tags;
            $video->published = $request->published;
            $video->slug = str_slug(str_limit($video->title,100,''))."-".$random;                        
            $video->category_id = $request->category_id;
            $video->content = '/'.$destinationPath.'/'.$new_file_name;
            $video->user_id = Auth::user()->id;
            $video->save();

            if(config('app.auto_approve') == 1){ 
            	$video->status = 1;
            	$success = 'Video successfully submitted. <a href="'.url('videos/'.$video->id.'/'.$video->slug).'">Click here</a> to watch the video.';
            }
            else{
            	$video->status = 0;
            	$success = 'Video successfully submitted. Please wait for administrator approval';
            }

            $video->save();
   
            return redirect()->back()->withSuccess($success);

    	}
    	else
    	{
            if(config('app.user_embed') != 1 && \Auth::user()->role != 1) return redirect()->back()->withErrors(__('User embed is disabled'));

    		$max_thumbnail_upload_size = config('app.max_thumbnail_upload_size') * 1024;
	       	$validator = Validator::make($request->all(), [
	            'type' => 'required|numeric|in:1,2',
	            'title' => 'required|min:5|max:100',
	            'description' => 'max:2000',
	            'tags' => 'max:200',
	            'category_id' => 'required|numeric|exists:categories,id',
	            'published' => 'required|numeric|in:0,1',
	            'embed_code' => 'required|max:2000',
	            'thumbnail' => 'mimes:jpeg,png|max:'.$max_thumbnail_upload_size,
	        ]);
	       	if ($validator->fails()) 
	       	{
	            return redirect()->back()
	                        ->withErrors($validator)->withInput();
	        }
	        $video = new Video();
	        $destinationPath = 'uploads/'.date('Y').'/'.date('m').'/'.date('d');
	        if(!file_exists($destinationPath)){
	        	mkdir($destinationPath,0755,true);
	        }
	        $random = str_random(10); 

	        if($request->hasFile('thumbnail'))
	        {
	        	$thumbnail = $request->file('thumbnail');
	        	$file_ext = $thumbnail->getClientOriginalExtension();
	        	$thumbnail_name = $random.'.'.$file_ext;
	        	$thumbnail->move($destinationPath,$thumbnail_name);
	        	$video->thumbnail = '/'.$destinationPath.'/'.$thumbnail_name;
	        }

            $video->type  = 2;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->tags = $request->tags;
            $video->published = $request->published;
            $video->slug = str_slug($video->title)."-".$random;                        
            $video->category_id = $request->category_id;
            $video->content = $request->embed_code;
            $video->user_id = Auth::user()->id;
            $video->save();

            if(config('app.auto_approve') == 1){ 
            	$video->status = 1;
            	$success = 'Video successfully submitted. <a href="'.url('videos/'.$video->id.'/'.$video->slug).'">Click here</a> to watch the video.';
            }
            else{
            	$video->status = 0;
            	$success = 'Video successfully submitted. Please wait for administrator approval';
            }

            $video->save();

            return redirect()->back()->withSuccess($success);
    	}

    }

    public function deleteVideo($id)
    {
        $video = Video::where('id',$id)->where('user_id',Auth::user()->id)->firstOrfail();


        if($video->type == 1){
        	$file = ltrim($video->content,'/');
            if(file_exists($file)){
                @unlink($file);
            }
        }

        if(!empty($video->thumbnail)){
        	$thumbnail = ltrim($video->thumbnail,'/');
        	if(file_exists($thumbnail)){
        		@unlink($thumbnail);
        	}
        }

    /*    \risul\LaravelLikeComment\Models\Comment::where('item_id',$video->id)->delete();
        \risul\LaravelLikeComment\Models\Like::where('item_id',$video->id)->delete();
        \risul\LaravelLikeComment\Models\TotalLike::where('item_id',$video->id)->delete();*/

        $video->delete();
        return redirect()->back()->withSuccess('Video successfully deleted'); 
    }

    public function edit($id)
    {
        $data['video'] = Video::where('id',$id)->where('user_id',Auth::user()->id)->firstOrfail();

        return view('front.videos.edit',$data)->with('page_title','Edit Video');
    }

        public function update($id, Request $request)
    {
        $video = Video::where('id',$id)->where('user_id',Auth::user()->id)->firstOrfail();

        $rules = [
            'title' => 'required|min:5|max:100',
            'description' => 'max:9000',
            'category_id' => 'required|numeric|exists:categories,id',
            'published' => 'required|numeric|in:0,1',
            'tags' => 'max:200'
        ];

        if($video->type == 2)
        {
            $rules['embed_code'] = 'required|max:2000';
        }


        $validator = Validator::make($request->all(), $rules);
       if ($validator->fails()) 
       {
            return redirect()->back()
                        ->withErrors($validator)->withInput();
        }
        else 
        { 
            if($request->hasFile('thumbnail'))
            {

                if(!empty($video->thumbnail)){
                    @unlink(ltrim($video->thumbnail,'/'));
                }               

                $destinationPath = 'uploads/'.date('Y').'/'.date('m').'/'.date('d');
                if(!file_exists($destinationPath)){
                    mkdir($destinationPath,0755,true);
                }
                $random = str_random(10); 

                $thumbnail = $request->file('thumbnail');
                $file_ext = $thumbnail->getClientOriginalExtension();
                $thumbnail_name = $random.'.'.$file_ext;
                $resized_thumbnail_name = $random.'_320x180.'.$file_ext;

                $thumbnail->move($destinationPath,$thumbnail_name);
                $original_thumbnail = $destinationPath.'/'.$thumbnail_name;

                Image::make($original_thumbnail)->resize(320, 180)->save($destinationPath.'/'.$resized_thumbnail_name);

                $video->thumbnail = '/'.$destinationPath.'/'.$resized_thumbnail_name;
                @unlink($original_thumbnail);
            }


            $video->title = $request->title;
            $video->description = $request->description;
            $video->slug = str_slug(str_limit($request->title,100,''))."-".str_random(10);
            $video->category_id = $request->category_id;
            $video->published = $request->published;
            $video->tags = $request->tags;


            if($video->type == 2) 
            {
                if($video->content != $request->embed_code)
                {
                    if(config('app.auto_approve') == 1){ 
                        $video->status = 1;
                        $success = 'Video successfully updated. <a href="'.url('videos/'.$video->id.'/'.$video->slug).'">Click here</a> to watch the video.';
                    }
                    else{
                        $video->status = 0;
                        $success = 'Video successfully re-submitted. Please wait for administrator approval';
                    }
                    $video->content = $request->embed_code;
                }
            }

            $video->save();
            return redirect()->back()->withSuccess($success);
        }

    }

    public function myVideos()
    {
        $data['videos'] = Video::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('front.videos.my_videos',$data)->with('page_title','My Videos');
    }

    public function player($id,$slug)
    {

    	if(Auth::check())
    	{
    		if(Auth::user()->role == 1)
    		{
				$video = Video::where('id',$id)->firstOrfail();
    		}
    		else{
    			$video = Video::where('id',$id)->where('status',1)->where('published',1)->where('type',1)->firstOrfail();
    		}
        	
    	}
    	else{
    		$video = Video::where('id',$id)->where('status',1)->where('published',1)->where('type',1)->firstOrfail();
    	}


    	$random = rand(1,2);
    	$vast_ad = ($random == 1)?config('app.vast_ad1'):config('app.vast_ad2');

    	return view('front.videos.player',compact('video','vast_ad'))->with('page_title',$video->title);
    }

    public function embed($id,$slug)
    {

        if(Auth::check())
        {
            if(Auth::user()->role == 1)
            {
                $video = Video::where('id',$id)->firstOrfail();
            }
            else{
                $video = Video::where('id',$id)->where('status',1)->where('published',1)->firstOrfail();
            }
            
        }
        else{
            $video = Video::where('id',$id)->where('status',1)->where('published',1)->firstOrfail();
        }

        return view('front.videos.embed',compact('video'))->with('page_title',$video->title);
    }


    public function reportVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:video,id',
            'reason' => 'max:240|string',
        ]);
       	if ($validator->fails()) 
       	{
            return redirect()->back()->withErrors($validator);
        }  
        else{
        	$video = Video::findOrfail($request->id);

        	$report = new Report();
        	$report->video_id = $video->id;
        	$report->video_title = $video->title;
        	$report->user_id = Auth::user()->id;
        	$report->user_name = Auth::user()->name;
        	$report->user_email = Auth::user()->email;
        	$report->reason = $request->reason;
        	$report->save();

        	return redirect()->back()->withSuccess('Video successfully reported.');
        }

    }

    public function import()
    {
        if(config('app.user_import') != 1 && \Auth::user()->role == 1) return redirect()->back()->withInfo('This feature is currently disabled by site administrator');
    	if(empty(config('app.youtube_api_key'))) return redirect()->back()->withInfo('This feature is currently disabled by site administrator');
        return view('front.videos.import.index')->with('page_title','Import Videos');
    }   
    
    public function importSearch(Request $request)
    {
        if(config('app.user_import') != 1 && \Auth::user()->role == 1) return redirect()->back()->withInfo('This feature is currently disabled by site administrator');
    	if(empty(config('app.youtube_api_key'))) return redirect()->back()->withInfo('This feature is currently disabled by site administrator');        
        $validator = Validator::make($request->all(), [
            'q' => 'required|string|min:5|max:240',
        ]);
        if ($validator->fails()) {
            echo '<div class="alert alert-danger"><ul>';
            foreach ($validator->errors()->all() as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul></div>';       
        }
        else{

        	Youtube::setApiKey(config('app.youtube_api_key'));
			// Same params as before
			$params = [
			    'q'             => $request->q,
			    'type'          => 'video',
			    'part'          => 'id, snippet',
			    'maxResults'    => 48
			];

			$search = Youtube::searchAdvanced($params, true);

			if(count($search['results']) > 0){
				$videos = $search['results'];
				return view('front.videos.import.search',compact('videos'));
			}
			else{
	            echo '<div class="alert alert-danger"><ul>';
	            echo '<li>Please enter valid keyword for search.</li>';
	            echo '</ul></div>'; 				
			}

        }
    }  

    public function importVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vid' => 'required|min:3|max:50',
            'c' => 'required|max:240|exists:categories,id',
            'p' => 'required|numeric|in:0,1',
        ]);
        if ($validator->fails()) {
            echo 'error';       
        }
        else {

        	Youtube::setApiKey(config('app.youtube_api_key'));

        	// Return an STD PHP object
        	$video = Youtube::getVideoInfo($request->vid);

        	if($video != null)
        	{

        		$check = Video::where('content',$video->player->embedHtml)->first();

        		if(empty($check))
        		{
        			$v = new Video();
		            $v->type  = 2;
		            $v->title = $video->snippet->title;
		            $v->description = htmlentities(nl2br($video->snippet->description));
		            if(isset($video->snippet->tags)) $v->tags = implode(',',$video->snippet->tags);
		            $v->thumbnail = $video->snippet->thumbnails->medium->url;
		            $v->published = $request->p;
		            $v->slug = str_slug(str_limit($video->snippet->title,100,''))."-".str_random(10);                        
		            $v->category_id = $request->c;
		            $v->content = $video->player->embedHtml;
		            $v->user_id = Auth::user()->id;
		            $v->save();
		            
		            if(config('app.auto_approve') == 1){ 
		            	$v->status = 1;
		            	$success = 'Video successfully imported. <a href="'.url('videos/'.$v->id.'/'.$v->slug).'">Click here</a> to watch the video.';
		            }
		            else{
		            	$v->status = 0;
		            	$success = 'Video successfully imported. Please wait for administrator approval';
		            }
		            $v->save();
		            echo $success;
		        }     
		        else{
		        	echo 'Video already exists in database.';
		        }
	               		
        	}
        	else{
        		echo 'error';
        	}

        }    	
    }
}