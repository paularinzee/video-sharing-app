<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Page;
use App\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Input;
use Mail;

class PageController extends Controller
{

	public function show($slug)
	{				
		$page = Page::where('slug',$slug)->where('active',1)->firstOrfail();
		
		return view('front.pages.show',compact('page'))->with('page_title',$page->title);
	}

 	public function contact()
    {   
        return view('front.pages.contact')->with('page_title','Contact Us');
    }

    public function contactPost(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|min:10|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $site_email = Setting::where('option','site_email')->first();

            $to = $site_email->value;
            try {
                Mail::send('emails.contact', ['request' => $request], function ($m) use($to){
                    $m->to($to)->subject(config('app.site_name') . ' - ' . __('Contact Message'));
                });
            } catch (\Exception $e) {
                \Log::info($e->getMessage());
                return redirect('contact')->with('warning', __('Your message was not sent due to invalid mail configuration'));
            }

            $success = 'success';
            return redirect('contact')->with('success',$success); 
        }        
    }

    public function sitemaps()
    {
        $first = Video::orderBy('created_at')->firstOrfail();

        $last = Video::orderBy('created_at','DESC')->firstOrfail();

        $start_date = $first->created_at->format('Y-m-d');
        $end_date = $last->created_at->format('Y-m-d');

        return response()->view('front.pages.sitemaps',compact('start_date','end_date'))->header('Content-Type', 'text/xml');
    }


    public function sitemapMain()
    {
        $pages = Page::where('active', 1)->get(['slug']);

        $categories = \App\Category::get(['slug']);
        return response()->view('front.pages.sitemap_main', compact('pages', 'categories'))->header('Content-Type', 'text/xml');
    }

    public function sitemap($date)
    {
        $videos = Video::where('published',1)->where('status',1)->whereHas('user')
        ->whereDate('created_at',$date)->get();
        return response()->view('front.pages.sitemap',compact('videos'))->header('Content-Type', 'text/xml');
    }


}