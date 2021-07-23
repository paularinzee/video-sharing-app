<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug',$slug)->firstOrfail();
        $data['videos'] = Video::where('status',1)->where('published',1)->where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(24);        
        return view('front.category.index',$data)->with('category',$category)->with('page_title',$category->name);
    }

}