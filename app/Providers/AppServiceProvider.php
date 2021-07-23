<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Category;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('DB_DATABASE') == 'MY_DBNAME'){
             redirect('/install')->send();
        }
    	
        $settings = Setting::all();
        foreach ($settings as $setting) {
            config(['app.'.$setting->option => $setting->value]);
            $data[$setting->option] = $setting->value;
        }


        \Config::set('mail.driver', config('app.mail_driver'));
        \Config::set('mail.host', config('app.mail_host'));
        \Config::set('mail.port', config('app.mail_port'));
        \Config::set('mail.username', config('app.mail_username'));
        \Config::set('mail.password', config('app.mail_password'));
        \Config::set('mail.encryption', config('app.mail_encryption'));
        \Config::set('mail.from.address', config('app.mail_from_address'));
        \Config::set('mail.from.name', config('app.mail_from_name'));


        $data['categories'] = Category::orderBy('name')->get();
        view()->share($data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
