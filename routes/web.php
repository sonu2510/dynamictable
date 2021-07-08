<?php

use Illuminate\Support\Facades\Route;

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
if(Auth::check())
{

	Route::get('/', function () {
    return view('home');
});
}else{	
	Route::get('/', function () {
    return view('auth.login');
});
}
Route::get('/logout', function () {
	Auth::logout();
	Session::flush();
	return redirect('/');
})->name('logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('sendbasicemail','MailController@basic_email');
//Route::get('sendhtmlemail','MailController@html_email');
//Route::get('sendattachmentemail','MailController@attachment_email');
Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact', 'ContactController@contactPost')->name('contactPost');



Route::get('subscribe-process', [
    'as' => 'subscribe-process',
    'uses' => 'SigninController@SubscribProcess'
]);


Route::get('subscribe-cancel', [
    'as' => 'subscribe-cancel',
    'uses' => 'SigninController@SubscribeCancel'
]);

Route::get('subscribe-response', [
    'as' => 'subscribe-response',
    'uses' => 'SigninController@SubscribeResponse'
]);

 

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
