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

class UserController extends Controller
{

	public function doLogin() 
    {
        
        // validate the info, create rules for the inputs
        $rules = array('email' => 'required|email',
         // make sure the email is an actual email
        'password' => 'required|min:3'
        
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            echo '<div class="alert alert-danger"><ul>';
            foreach ($validator->errors()->all() as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul></div>';       
        } 
        else {
            
            // create our user data for the authentication
            $userdata = array('email' => Input::get('email'), 'password' => Input::get('password'));
            
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                if(Auth::user()->active == 0){                    
                    echo "<div class='alert alert-info'>Account not active, please check your email to complete the registration process. If you haven't received activation email <a href='".url('resend/'.Auth::user()->id.'/activate')."'>click here</a></div>";
                    Auth::logout();
                }
            } 
            else {
                
                // validation not successful, send back to form
                echo "<div class='alert alert-danger'>Invalid Email address or Password</div>";
            }
        }
    }

    public function register(Request $request)
    {
         // validate the info, create rules for the inputs
        $rules = array('name'=> 'required|min:3|unique:users,name','email' => 'required|email|unique:users,email',
         // make sure the email is an actual email
        'password' => 'required|min:6'
        
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            echo '<div class="alert alert-danger"><ul>';
            foreach ($validator->errors()->all() as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul></div>';

        } 
        else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 2;
            $user->active = 0;
            $activation_code = sha1(rand());
            $user->activation_code = $activation_code;
            $user->save();

            Mail::send('emails.activate',['user'=>$user], function ($m) use ($user) {
            //    $m->from('noreply@example.com', config('app.site_name'));
                $m->to($user->email)->subject('Activation mail');
            });

            echo '<div class="alert alert-success">Success! Your account successfully created. Please check your email box and follow instructions to confirm registration.</div>';
        }
    }

    public function activate($activation_code)
    {
        $user = User::where('active',0)->where('activation_code',$activation_code)->first();
        if(!empty($user)){
            $user->active = 1;
            $user->save();
            $status = 'Account successfully activated.';
        }
        else {
            $status = 'Account activation code invalid.';
        }
        echo '<html>
                <head>
                    <meta http-equiv="refresh" content="3;url='.url('/').'" />
                </head>
                <body>
                    <h2>'.$status.'</h2>
                    <p>Redirecting in 3 seconds...</p>
                </body>
            </html>';
    }

    public function resendActivationCode($id)
    {
        $user = User::find($id);
        if(!empty($user)){

            Mail::send('emails.activate',['user'=>$user], function ($m) use ($user) {
              //  $m->from('noreply@example.com', config('app.site_name'));
                $m->to($user->email)->subject('Activation mail');
            });
            $status = 'Account activation code successfully sent to your email address';
            echo '<html>
                <head>
                    <meta http-equiv="refresh" content="3;url='.url('/').'" />
                </head>
                <body>
                    <h2>'.$status.'</h2>
                    <p>Redirecting in 3 seconds...</p>
                </body>
            </html>';
        }
        else{
            return redirect('/');
        }
    }

    public function recover()
    {
        // validate the info, create rules for the inputs
        $rules = array('email' => 'required|email|exists:users,email',
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            echo '<div class="alert alert-danger"><ul>';
            foreach ($validator->errors()->all() as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul></div>';
        } 
        else {
            $user = User::where('email',Input::get('email'))->first();

            $new_password = str_random(8);
            $user->password = bcrypt($new_password);
            $user->save();
            $recover = ['password' => $new_password];
            Mail::send('emails.recover',$recover, function ($m) use ($user) {
             //   $m->from('noreply@example.com', config('app.site_name'));
                $m->to($user->email)->subject('Recover Account');
            });

            echo '<div class="alert alert-success">Success! Your account successfully recovered. Please check your email box and follow instructions.</div>';            
        }

    }  

    public function password()
    {
        return view('front.user.password')->with('page_title','Change Password');
    }  

    public function updatePassword(Request $request)
    {

       $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:5|max:100',
            'password' => 'required|min:5|max:100|confirmed',
            'password_confirmation' => 'required|min:5|max:100'
        ]);
       if ($validator->fails()) {
            return redirect('password')
                        ->withErrors($validator);
        }
        else {  
            $user = User::where('id', Auth::user()->id)->first();

            if(Hash::check($request->current_password,$user->password)) {
                
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect('password')->withStatus('Success! Password successfully changed.');
            } 
            else {
                $errors = array('Error! Invalid password');
                return redirect('password')->withErrors($errors);
            }


        }


    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return redirect('/'); // redirect the user to the login screen
    }  

}