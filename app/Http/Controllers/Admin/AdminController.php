<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index')->with('page_title','Dashboard');
    }

    public function edit()
    {   
        $user = User::where('id',Auth::user()->id)->firstOrfail();
        return view('admin.profile.edit',compact('user'))->with('page_title','Edit Profile');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,25',
            'email' => 'required|email|between:3,25',
            'password' => 'sometimes|max:50|confirmed',
            'password_confirmation' => '',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $user = User::where('id',Auth::user()->id)->firstOrfail();
            $user->name = $request->name;
            $user->email = $request->email;
            if(!empty($request->password)) $user->password = Hash::make($request->password);

            $user->save();
            return redirect()->back()->withSuccess('Successfully updated.');
        }        
    }

 	public function login()
    {
        if(\Auth::check()) return redirect('admin/dashboard');
        return view('admin.auth.login')->with('page_title','Login');
    }

    public function doLogin(Request $request)
    {
    	if(\Auth::check()) return redirect('admin/dashboard');
        $validator = Validator::make($request->all(), [
            'username' => 'required|between:3,25',
            'password' => 'required|between:6,25',
            'remember' => 'max:2',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $username = $request->username;
            $password = $request->password;
            if($request->remember == 'on') $remember = true;
            else $remember = false;
            if (Auth::attempt(['email'=> $username, 'password' => $password], $remember)) {
               	return redirect('admin/dashboard');            
            } 
            else {
                return redirect()->back()->withErrors('Invalid Username or Password.');
            }  
        }

    }    

    public function logout()
    {
    	Auth::logout();
    	return redirect('admin/login')->withSuccess('Logout Successful.');
    }

}