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
    Route::post('/sign', 'SignController@store')->name('sign.store');
    Route::get('/share', 'JssdkController@index')->name('share.index');
//    Route::get('/lottery', 'GoodController@index')->name('lottery.index');
});

Route::get('/go', function () {
    return redirect('http://i.eqxiu.com/s/h3J0R6mM?share_level=1&from_user=067b0979-a11c-46a4-ad1f-0bbabf4facc3&from_id=5b7233d6-c8df-4c09-a5bc-4f89033f6d64&share_time=1506753814634');
});

//抽奖相关路由
Route::get('/lottery', 'LotteryController@index')->name('lottery.index');
Route::get('/lottery/get_win', 'LotteryController@start')->name('lottery.start');
Route::get('/lottery/get_list','LotteryController@get_list')->name('lottery.get_list');
Route::get('/lottery/set_goods', 'LotteryController@show')->name('lottery.show');
Route::get('/lottery/edit_goods', 'LotteryController@edit')->name('lottery.edit');

Route::get('/lottery/change_goods/{good}', 'LotteryController@change')->name('lottery.change');
Route::patch('/lottery/update_goods/{good}', 'LotteryController@update')->name('lottery.update');
Route::delete('/lottery/set_goods/{good}', 'LotteryController@destroy')->name('lottery.destroy');
Route::post('/lottery/store_goods','LotteryController@store')->name('lottery.store');

//奖品相关
Route::get('/prize', 'PrizeController@index')->name('prize.index');
Route::patch('/prize', 'PrizeController@update')->name('prize.update');

