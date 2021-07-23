<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Validator;
use Auth;

use Yajra\Datatables\Facades\Datatables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index')->with('page_title','Categories');
    }

    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('admin.categories.edit',compact('category'))->with('page_title','Edit Category');
    }    

    public function create()
    {
        return view('admin.categories.create')->with('page_title','Create Category');
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:40|unique:categories,name',
        ]);
       if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {  
            $category = new Category();
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
            $category->save();

            return redirect()->back()->withSuccess('Successfully added.');
        }       
    }

    public function update($id,Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:40',
        ]);
       if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {  
            $category = Category::findOrfail($id);
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
            $category->save();

            return redirect()->back()->withSuccess('Successfully updated.');
        }       
    }

    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Successfully deleted.');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select();
            return Datatables::of($categories)               
                ->addColumn('action', function($category){
                    return '<a class="btn btn-xs btn-default" href="'.url('admin/categories/'.$category->id.'/edit').'"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-xs btn-default" href="'.url('admin/categories/'.$category->id.'/delete').'"><i class="fa fa-trash"></i> Delete</a>';
                })
            ->make(true);
        }
    }
}