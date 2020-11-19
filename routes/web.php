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
Route::post('/login', 'AuthController@postLogin');
Route::post('/register', 'AuthController@postRegister');
Route::get('/logout', 'AuthController@logout');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/allsekolah', 'DashboardController@allsekolah');
Route::get('/allkepsek', 'DashboardController@allkepsek');
Route::get('/allbendahara', 'DashboardController@allbendahara');

Route::get('/lihatprofil', 'ProfilController@lihatprofil');

Route::get('/pengajuan', 'PengajuanController@awal');
Route::get('/pengajuan/tambah', 'PengajuanController@buatPengajuan');
Route::get('/pengajuan/tambahDetail/{id}', array('as'=>'tambahDetail', 'uses'=>'PengajuanController@tambahDetailPengajuan'));
Route::post('/pengajuan/postPengajuan', 'PengajuanController@postPengajuan');
Route::post('/pengajuan/postDetail', 'PengajuanController@postDetail')->name('detail-field.insert');
Route::get('/pengajuan/download_template', 'PengajuanController@downloadCoursesTemplate');
Route::delete('/pengajuan/hapus/{Pengajuan}', 'PengajuanController@hapusPengajuan');
Route::put('/pengajuan/edit/{Pengajuan}', 'PengajuanController@editPengajuan');

// Route::get('/pengajuan/detail/{id}', 'PengajuanController@detailPengajuan');
Route::get('/pengajuan/detail/{id}', array('as'=>'detailawal', 'uses'=>'PengajuanController@detailPengajuan'));
Route::delete('/detailpengajuan/hapus/{Pengajuan}/{DetailPengajuan}', 'PengajuanController@hapusdetailPengajuan');
Route::put('/detailpengajuan/edit/{Pengajuan}/{DetailPengajuan}','PengajuanController@editdetailPengajuan');