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

Route::get('/', 'AuthController@loginIndex')->name('login');
Route::get('/register', 'AuthController@registerIndex');
Route::post('/login', 'AuthController@postLogin');
Route::post('/register', 'AuthController@postRegister');
Route::get('/logout', 'AuthController@logout')->middleware('cekstatus');

Route::get('/dashboard', 'DashboardController@index')->middleware('cekstatus');
Route::get('/allsekolah', 'DashboardController@allsekolah')->middleware('cekstatus');
Route::get('/allkepsek', 'DashboardController@allkepsek')->middleware('cekstatus');
Route::get('/allbendahara', 'DashboardController@allbendahara')->middleware('cekstatus');

Route::get('/lihatprofil', 'ProfilController@lihatprofil')->middleware('cekstatus');

Route::get('/pengajuan', 'PengajuanController@awal');
Route::get('/pengajuan/tambah', 'PengajuanController@buatPengajuan');
Route::get('/pengajuan/tambahDetail/{id}', array('as'=>'tambahDetail', 'uses'=>'PengajuanController@tambahDetailPengajuan'));
Route::post('/pengajuan/postPengajuan', 'PengajuanController@postPengajuan');
Route::post('/pengajuan/postDetail', 'PengajuanController@postDetail')->name('pengajuan.postDetail');
// Route::get('/pengajuan/download_template', 'PengajuanController@downloadCoursesTemplate');
Route::delete('/pengajuan/hapus/{Pengajuan}', 'PengajuanController@hapusPengajuan');
Route::put('/pengajuan/edit/{Pengajuan}', 'PengajuanController@editPengajuan');
Route::post('/pengajuan/cekjudul/{judul}', 'PengajuanController@cekjudul');
// Route::get('/pengajuan/getJabatan/{id}', 'PengajuanController@getJabatan');
Route::get('/pengajuan/getJabatan', 'PengajuanController@getJabatan')->name('pengajuan.getJabatan');
Route::get('/pengajuan/getDetail', 'PengajuanController@getDetail')->name('pengajuan.getDetail');

// Route::get('/pengajuan/detail/{id}', 'PengajuanController@detailPengajuan');
Route::get('/pengajuan/detail/{id}', array('as'=>'detailawal', 'uses'=>'PengajuanController@detailPengajuan'));
Route::delete('/detailpengajuan/hapus/{Pengajuan}/{DetailPengajuan}', 'PengajuanController@hapusdetailPengajuan');
Route::put('/detailpengajuan/edit/{Pengajuan}/{MappingDetailPengajuan}','PengajuanController@editdetailPengajuan');