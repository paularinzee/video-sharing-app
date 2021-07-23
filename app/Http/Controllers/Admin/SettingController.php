<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Validator;
use Auth;


class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::all();
        foreach ($settings as $setting) {
            $data[$setting->option] = $setting->value;
        }

        return view('admin.settings.index',$data)->with('page_title','Settings');
    }

    public function update(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'site_name' => 'required|min:5|max:25',
            'site_email' => 'required|email',
            'site_logo' => 'sometimes|mimes:png|max:1024',
            'comments' => 'required|in:0,1,2',
            'ad' => 'required|in:0,1',            
            'auto_approve' => 'required|in:0,1',            
            'user_upload' => 'required|in:0,1',            
            'user_embed' => 'required|in:0,1',            
            'user_import' => 'required|in:0,1',            
            'video_download' => 'required|in:0,1',            
            'max_video_upload_size' => 'required|numeric',
            'max_thumbnail_upload_size' => 'required|numeric',
            'youtube_api_key' => 'required|max:255',
            'mail_driver'   => 'required|in:mail,smtp',
            'mail_encryption'   => 'required|in:tls,ssl'
        ]);
       if ($validator->fails()) {
            return redirect('admin/settings')
                        ->withErrors($validator)
                        ->withInput();
        }
        else { 

            Setting::where('option','site_name')->update(['value'=>$request->site_name]);
            Setting::where('option','site_email')->update(['value'=>$request->site_email]);
            Setting::where('option','meta_description')->update(['value'=>$request->meta_description]);
            Setting::where('option','meta_keywords')->update(['value'=>$request->meta_keywords]);

            Setting::where('option','comments')->update(['value'=>$request->comments]);

            Setting::where('option','max_video_upload_size')->update(['value'=>$request->max_video_upload_size]);
            Setting::where('option','max_thumbnail_upload_size')->update(['value'=>$request->max_thumbnail_upload_size]);



            Setting::where('option','disqus_code')->update(['value'=>htmlentities($request->disqus_code)]);       
            Setting::where('option','google_analytics')->update(['value'=>htmlentities($request->google_analytics)]);       

            Setting::where('option','ad')->update(['value'=>$request->ad]);
            Setting::where('option','user_upload')->update(['value'=>$request->user_upload]);
            Setting::where('option','user_embed')->update(['value'=>$request->user_embed]);
            Setting::where('option','user_import')->update(['value'=>$request->user_import]);
            Setting::where('option','video_download')->update(['value'=>$request->video_download]);


            Setting::where('option','ad1')->update(['value'=>htmlentities($request->ad1)]);
            Setting::where('option','ad2')->update(['value'=>htmlentities($request->ad2)]);
            Setting::where('option','ad3')->update(['value'=>htmlentities($request->ad3)]);
            Setting::where('option','ad4')->update(['value'=>htmlentities($request->ad4)]);
            Setting::where('option','vast_ad1')->update(['value'=>$request->vast_ad1]);
            Setting::where('option','vast_ad2')->update(['value'=>$request->vast_ad2]);
            Setting::where('option','skin')->update(['value'=>$request->skin]);

            Setting::where('option','social_fb')->update(['value'=>$request->social_fb]);
            Setting::where('option','social_pinterest')->update(['value'=>$request->social_pinterest]);
            Setting::where('option','social_gplus')->update(['value'=>$request->social_gplus]);
            Setting::where('option','social_twitter')->update(['value'=>$request->social_twitter]);

            Setting::where('option','auto_approve')->update(['value'=>$request->auto_approve]);
            Setting::where('option','youtube_api_key')->update(['value'=>$request->youtube_api_key]);
            Setting::where('option','videos_per_page')->update(['value'=>$request->videos_per_page]);
            Setting::where('option','footer_text')->update(['value'=>$request->footer_text]);


            
            Setting::where('option','mail_driver')->update(['value'=>$request->mail_driver]);
            Setting::where('option','mail_host')->update(['value'=>$request->mail_host]);
            Setting::where('option','mail_username')->update(['value'=>$request->mail_username]);
            Setting::where('option','mail_password')->update(['value'=>$request->mail_password]);
            Setting::where('option','mail_port')->update(['value'=>$request->mail_port]);
            Setting::where('option','mail_encryption')->update(['value'=>$request->mail_encryption]);
            Setting::where('option','mail_from_name')->update(['value'=>$request->mail_from_name]);
            Setting::where('option','mail_from_address')->update(['value'=>$request->mail_from_address]);

            if($request->hasFile('site_logo'))
            {
                $file = $request->file('site_logo');
                $destinationPath = 'img';
                $file_name = 'logo.png';
                $file->move($destinationPath,$file_name);
                $new_file_name = '/'.$destinationPath.'/'.$file_name.'?v='.time();
                Setting::where('option','site_logo')->update(['value'=>$new_file_name]);
            }



            return redirect()->back()->withSuccess('Success! Settings successfully saved');

        }

    }
}