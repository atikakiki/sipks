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
Route::get('/profile', 'ApiController@getprofile')->middleware('auth:api');

Route::get('/pengajuan', 'ApiController@getpengajuan')->middleware('auth:api');

Route::get('pengajuan/detail/{id}', [
     'as'         => 'detail',
     'uses'       => 'ApiController@getdetail',
     'middleware' => 'auth:api',
]);