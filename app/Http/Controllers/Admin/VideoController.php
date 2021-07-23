<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Category;
use Validator;
use Auth;
use Image;

use Yajra\Datatables\Facades\Datatables;

class VideoController extends Controller
{
    public function index()
    {
        return view('admin.videos.index')->with('page_title','Videos');
    }

    public function edit($id)
    {
        $video = Video::findOrfail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.videos.edit',compact('video','categories'))->with('page_title','Edit Video');
    }

    public function update($id,Request $request)
    {
        header('X-XSS-Protection:0');

        $video = Video::findOrfail($id);

        $max_thumbnail_upload_size = config('app.max_thumbnail_upload_size') * 1024;

        $rules = [
            'title' => 'required|min:5|max:100',
            'description' => 'max:9000',
            'tags' => 'max:1000',
            'category_id' => 'required|numeric|exists:categories,id',
            'published' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
            'featured' => 'required|numeric|in:0,1',
            'thumbnail' => 'sometimes|mimes:png,jpeg,jpg|max:'.$max_thumbnail_upload_size,
        ];

        if($video->type == 2)
        {
            $rules['content'] = 'required|max:2000';
        }


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return redirect()->back()
                        ->withErrors($validator)->withInput();
        }
        else 
        {
            $video->title = $request->title;
            $video->slug = str_slug(str_limit($request->title,100,'')).'-'.str_random(10);
            $video->description = $request->description;
            $video->tags = $request->tags;
            $video->category_id = $request->category_id;
            $video->published = $request->published;
            $video->status = $request->status;
            $video->featured = $request->featured;
            if($video->type == 2) $video->content == $request->content;
         

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


            $video->save();
            return redirect()->back()->withSuccess('Video Successfully updated.');

        }
      
    }

    public function destroy($id)
    {
        $video = Video::findOrfail($id);

        if($video->type == 1){
            $file = ltrim($video->content,'/');
            if(file_exists($file)) @unlink($file);
        }

        if(!empty($video->thumbnail)){
            $thumbnail = ltrim($video->thumbnail,'/');
            if(file_exists($thumbnail)) @unlink($thumbnail);
        }   

     /*   \risul\LaravelLikeComment\Models\Comment::where('item_id',$video->id)->delete();
        \risul\LaravelLikeComment\Models\Like::where('item_id',$video->id)->delete();
        \risul\LaravelLikeComment\Models\TotalLike::where('item_id',''.$video->id.'')->delete();     */        

        $video->delete();
        return redirect()->back()->withSuccess('Successfully deleted.');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $videos = Video::select()->orderBy('created_at','DESC');
            return Datatables::of($videos)   
                ->addColumn('check',function($video){
                    return '<input type="checkbox" class="check" name="check[]" value="'.$video->id.'">';
                })                
                ->addColumn('user',function($video){
                    if(isset($video->user)) return '<a href="'.url('users/'.$video->user->name.'/edit').'">'.$video->user->name.'</a>';
                    else return 'anonymous';
                })
                ->editColumn('video',function($video){
                    return '<a target="_blank" href="'.$video->url.'">'.$video->title.'</a>';
                })
                ->editColumn('type',function($video){
                    return ($video->type == 1)?"Uploaded":"Embeded";
                })                  
                ->addColumn('category',function($video){
                    return (isset($video->category))?$video->category->name:'Uncategorized';
                }) 
                ->editColumn('thumbnail',function($video){
                    if(empty($video->thumbnail)) return 'No thumbnail';
                    return '<a class="view_img" data-lightbox="image-1" href="'.$video->thumbnail.'"> View</a>';
                })                                 
                ->editColumn('published',function($video){
                    return ($video->published == 0)?'No':'Yes';
                })                  
                ->editColumn('status',function($video){
                    return ($video->status == 0)?'<span class="text-purple">Pending</span>':'<span class="text-green">Approved</span>';
                })                
                ->editColumn('featured',function($video){
                    return ($video->featured == 0)?'No':'Yes';
                })                 
                ->editColumn('views',function($video){
                    return number_format($video->views);
                })          
                ->addColumn('action', function($video){
                    return '<a class="btn btn-xs btn-default" href="'.url('admin/videos/'.$video->id.'/edit').'"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-xs btn-default" href="'.url('admin/videos/'.$video->id.'/delete').'"><i class="fa fa-trash"></i> Delete</a>';
                })
            ->make(true);
        }
    }

    public function deleteSelected(Request $request)
    {
        if(!empty($request->ids)){
            $videos = Video::whereIn('id',$request->ids)->get();
            foreach($videos as $video){
                $i = Video::find($video->id);
                if($i->type == 1){
                    $file = ltrim($i->content,'/');
                    if(file_exists($file)) @unlink($file);
                }

                if(!empty($i->thumbnail)){
                    $thumbnail = ltrim($i->thumbnail,'/');
                    if(file_exists($thumbnail)) @unlink($thumbnail);
                }

                \risul\LaravelLikeComment\Models\Comment::where('item_id',$i->id)->delete();
                \risul\LaravelLikeComment\Models\Like::where('item_id',$i->id)->delete();
                \risul\LaravelLikeComment\Models\TotalLike::where('item_id',$i->id)->delete();


                $i->delete();
            }
            echo "success";
        }
        else{
            echo "error";
        }        
    }       

    public function approveSelected(Request $request)
    {
        if(!empty($request->ids)){
            Video::whereIn('id',$request->ids)->update(['status'=>1]);
            echo "success";
        }
        else{
            echo "error";
        }        
    } 

}