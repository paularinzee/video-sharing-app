<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;

use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index')->with('page_title','Users');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select()->orderBy('id','DESC');
            return Datatables::of($users)     
                ->editColumn('role',function($user){
                    return ($user->role == 1)?'Administrator':'Registered User';
                })  
                ->addColumn('status',function($user){
                    if($user->active == 0) return '<span class="text-yellow">Inactive</span>';
                    elseif($user->active == 1) return '<span class="text-green">Active</span>';
                    else return '<span class="text-red">Banned</span>';
                })                                         
                ->addColumn('action', function($user){
                    return '<a class="btn btn-xs btn-default" href="'.url('admin/users/'.$user->id.'/edit').'"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-xs btn-default" href="'.url('admin/users/'.$user->id.'/delete').'"><i class="fa fa-trash"></i> Delete</a>';
                })
            ->make(true);
        }
    }

    public function create()
    {
        return view('admin.user.create')->with('page_title','Create User');
    }    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,25',
            'email' => 'required|email|between:3,25',
            'password' => 'required|max:50|confirmed',
            'role' => 'required|numeric|in:1,2',
            'active' => 'required|numeric|in:0,1,2',
            'password_confirmation' => '',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->activation_code = sha1(time());
            $user->role = $request->role;
            $user->active = $request->active;
            $user->password = \Hash::make($request->password);

            $user->save();
            return redirect()->back()->withSuccess('Successfully created.');
        }       
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.user.edit',compact('user'))->with('page_title','Edit User');
    }

    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,25',
            'email' => 'required|email|between:3,25',
            'password' => 'sometimes|max:50|confirmed',
            'role' => 'required|numeric|in:1,2',
            'active' => 'required|numeric|in:0,1,2',
            'password_confirmation' => '',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $user = User::where('id',$id)->firstOrfail();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->active = $request->active;
            if(!empty($request->password)) $user->password = \Hash::make($request->password);

            $user->save();
            return redirect()->back()->withSuccess('Successfully updated.');
        }               
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->withSuccess('User Successfully deleted.');
    }
}