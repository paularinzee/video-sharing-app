<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use Validator;
use Auth;

use Yajra\Datatables\Facades\Datatables;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index')->with('page_title','Pages');
    }

    public function edit($id)
    {
        $page = Page::findOrfail($id);
        return view('admin.pages.edit',compact('page'))->with('page_title','Edit Page');
    }

    public function update($id,Request $request)
    {
       $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:40',
            'content' => 'required',
            'active' => 'required|numeric|in:0,1'
        ]);
       if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {  
            $page = Page::findOrfail($id);
            $page->title = $request->title;
            $page->content = htmlentities($request->content);
            $page->active = $request->active;
            $page->save();

            return redirect()->back()->withSuccess('Successfully updated.');
        }       
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::select();
            return Datatables::of($pages)
                ->editColumn('active', function($page){
                    if($page->active == 1) return 'Yes';
                    else return 'No';
                })                
                ->addColumn('action', function($page){
                    return '<a class="btn btn-xs btn-default" href="'.url('admin/pages/'.$page->id.'/edit').'"><i class="fa fa-edit"></i> Edit</a>';
                })
            ->make(true);
        }
    }
}