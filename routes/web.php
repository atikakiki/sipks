<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', 'AuthController@loginIndex');
Route::get('/register', 'AuthController@registerIndex');
Route::get('/logout', 'AuthController@logout');

Route::get('/dashboardtu', 'DashboardController@index');
Route::get('/allsekolah', 'DashboardController@allsekolah');
Route::get('/allkepsek', 'DashboardController@allkepsek');
Route::get('/allbendahara', 'DashboardController@allbendahara');

Route::get('/lihatprofil', 'ProfilController@lihatprofil');

Route::get('/pengajuanawal', 'PengajuanController@awal');