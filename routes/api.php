<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'ApiController@login');
// Route::post('/', 'ApiController@login')->name('login');
Route::get('/profile', 'ApiController@getprofile')->middleware('auth:api');

Route::get('/pengajuan', 'ApiController@getpengajuan')->middleware('auth:api');

Route::get('pengajuan/detail/{id}', [
     'as'         => 'detail',
     'uses'       => 'ApiController@getdetail',
     'middleware' => 'auth:api',
]);

Route::post('pengajuan/detail', 'ApiController@postPengajuan')->middleware('auth:api');

Route::post('postWajah', 'ApiController@postWajah')->middleware('auth:api');
Route::get('show/{filename}','ApiController@show')->middleware('auth:api');

Route::post('trainsignature','SignatureController@trainSignature')->middleware('auth:api');
Route::post('sendsignature','SignatureController@sendSignature')->middleware('auth:api');
Route::post('predictsignature','SignatureController@predictSignature')->middleware('auth:api');