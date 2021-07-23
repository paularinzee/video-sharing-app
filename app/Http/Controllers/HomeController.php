<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Video;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App;
use Input;
use Hash;
use Mail;
use Str;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class HomeController extends Controller
{

    public function index()
    {
        $videos = Video::where('status',1)->where('published',1)->orderBy('created_at','DESC')->paginate(config('app.videos_per_page'));

        $tvideos = Video::where('status',1)->where('published',1)->orderBy('views','DESC')->limit(4)->get();
        $fvideos = Video::where('status',1)->where('published',1)->where('featured',1)->orderBy('created_at','DESC')->limit(4)->get();

        return view('front.home.index',compact('videos','tvideos','fvideos'))->with('page_title','Home');
    } 


}