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

Route::any('/wechat', 'WeChatController@serve');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web', 'wechat.oauth:snsapi_userinfo']], function () {
    Route::get('/sign', 'SignController@index')->name('sign.index');
    Route::get('/share', 'JssdkController@index')->name('share.index');
});

Route::get('/go', function () {
    return redirect('http://i.eqxiu.com/s/h3J0R6mM?share_level=1&from_user=067b0979-a11c-46a4-ad1f-0bbabf4facc3&from_id=5b7233d6-c8df-4c09-a5bc-4f89033f6d64&share_time=1506753814634');
});
