<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group([
            'middleware' => 'web'
    ], function () {


Route::get('/','HomeController@index')->name('home');
Route::get('trending','VideoController@trending')->name('trending');


Route::get('pages/{page}','PageController@show')->name('page.show');

Route::get('search','VideoController@search')->name('search');
Route::get('contact','PageController@contact')->name('contact');
Route::post('contact','PageController@contactPost');


Route::post('register','UserController@register');
Route::post('login','UserController@doLogin');
Route::post('recover','UserController@recover');

Route::get('logout','UserController@doLogout');
Route::get('resend/{id}/activate','UserController@resendActivationCode');
Route::get('activate/{activation_code}','UserController@activate');

Route::get('watch/{id}/{slug}','VideoController@player');
Route::get('embed/{id}/{slug}','VideoController@embed')->name('video.embed');
Route::get('videos/{id}/{slug}','VideoController@show');
Route::get('ajax/search', 'VideoController@ajaxSearch')->name('ajax.search');

Route::get('sitemap-main.xml','PageController@sitemapMain')->name('sitemap.main');
Route::get('sitemap.xml','PageController@sitemaps')->name('sitemaps');
Route::get('sitemap-{date}.xml','PageController@sitemap')->name('sitemap.show');

});





//Front auth routes
Route::group([
            'middleware' => 'auth'
    ], function () {


//User Auth routes 
Route::get('my-videos', 'VideoController@myVideos');
Route::get('my-videos/{id}/delete', 'VideoController@deleteVideo');
Route::get('my-videos/{id}/edit', 'VideoController@edit');
Route::post('my-videos/{id}/edit', 'VideoController@update');
Route::get('upload','VideoController@showUpload');
Route::post('upload','VideoController@upload');
Route::get('password', 'UserController@password');
Route::post('password', 'UserController@updatePassword');
Route::get('history', 'VideoController@history');
Route::get('liked-videos', 'VideoController@likedVideos');
Route::get('saved-videos', 'VideoController@watchLater');
Route::get('history/{id}/remove', 'VideoController@removeHistory');
Route::get('liked-videos/{id}/remove', 'VideoController@removeLikedVideo');
Route::get('saved-videos/{id}/remove', 'VideoController@removeWatchLater');
Route::post('saved-videos/add', 'VideoController@addWatchLater');


Route::post('report-video','VideoController@reportVideo');

Route::get('import-videos','VideoController@import');
Route::post('import-search','VideoController@importSearch');
Route::post('import-video','VideoController@importVideo');

});



// Admin Routes
Route::group([
            'prefix' => 'admin',
            'namespace'  => 'Admin',
    ], function () {

Route::get('login', 'AdminController@login');
Route::post('login', 'AdminController@doLogin');


});



// Admin auth routes
Route::group([
            'middleware' => ['admin'],
            'prefix' => 'admin',
            'namespace'  => 'Admin',
    ], function () {


Route::get('dashboard','AdminController@dashboard')->name('dashboard');
Route::get('logout','AdminController@logout');

Route::get('videos','VideoController@index')->name('videos');
Route::get('videos/{id}/delete','VideoController@destroy')->name('videos.delete');
Route::get('videos/{id}/edit','VideoController@edit')->name('videos.edit');
Route::post('videos/{id}/edit','VideoController@update')->name('videos.update');
Route::get('videos/get-videos','VideoController@get')->name('videos.get');
Route::post('videos/delete-selected','VideoController@deleteSelected');
Route::post('videos/approve-selected','VideoController@approveSelected');

Route::get('reported-videos','ReportController@index')->name('reports');
Route::get('reported-videos/get','ReportController@get')->name('reports.get');
Route::get('reported-videos/{id}/delete','ReportController@destroy')->name('reports.delete');
Route::post('reported-videos/delete-selected','ReportController@deleteSelected');

Route::get('pages','PageController@index')->name('pages');
Route::get('pages/{id}/edit','PageController@edit')->name('pages');
Route::post('pages/{id}/edit','PageController@update');
Route::get('pages/get-pages','PageController@get')->name('pages.get');

Route::get('categories','CategoryController@index')->name('categories');
Route::get('categories/{id}/delete','CategoryController@destroy')->name('categories.delete');
Route::get('categories/create','CategoryController@create')->name('categories');
Route::post('categories/create','CategoryController@store');
Route::get('categories/{id}/edit','CategoryController@edit')->name('categories');
Route::post('categories/{id}/edit','CategoryController@update');
Route::get('categories/get-categories','CategoryController@get')->name('categories.get');

Route::get('profile','AdminController@edit')->name('profile');
Route::post('profile','AdminController@update');

Route::get('settings','SettingController@edit')->name('settings');
Route::post('settings','SettingController@update');


Route::get('users', 'UserController@index')->name('users');
Route::get('users/get', 'UserController@get')->name('users.get');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
Route::get('users/{id}/edit','UserController@edit');
Route::post('users/{id}/edit', 'UserController@update');
Route::get('users/create','UserController@create');
Route::post('users/create', 'UserController@store');

});  



Route::get('{slug}','CategoryController@index')->name('category.show');