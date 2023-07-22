<?php

use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    // Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    // return view('welcome');

    return redirect('/home');
});

Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('suratmasuk', 'SuratMasukController', [
    'only' => ['create', 'store']
]);
Route::get('suratmasuk', 'SuratMasukController@index');
Route::get('suratmasuk/{id}', 'SuratMasukController@show');
Route::get('suratmasuk/{id}/edit',  'SuratMasukController@edit');
Route::post('suratmasuk/update/{id}',  'SuratMasukController@update');
Route::delete('suratmasuk/destroy/{id}',  'SuratMasukController@destroy');


Route::post('upload_berkas', 'SuratMasukController@upload_berkas');
Route::get('get_berkas/{id}', 'SuratMasukController@get_berkas');
Route::get('del_berkas/surat_masuk/{id}', 'SuratMasukController@del_berkas');
Route::get('printsm/{id}', 'SuratMasukController@print');

Route::resource('suratkeluar', 'SuratKeluarController', [
    'only' => ['create', 'store']
]);

Route::get('suratkeluar', 'SuratKeluarController@index');
Route::get('suratkeluar/{id}', 'SuratKeluarController@show');
Route::get('suratkeluar/{id}/edit',  'SuratKeluarController@edit');
Route::post('suratkeluar/update/{id}',  'SuratKeluarController@update');
Route::delete('suratkeluar/destroy/{id}',  'SuratKeluarController@destroy');

Route::get('get_berkas_sk/{id}', 'SuratKeluarController@get_berkas');
Route::get('del_berkas/surat_keluar/{id}', 'SuratKeluarController@del_berkas_sk');

// Route::resource('profil', 'UserController');

Route::get('/home2', 'HomeController@home2');

Route::get('absen', 'AbsenController@index');
Route::get('karyawan', 'UserController@index');
Route::get('delete-all-karyawan', 'UserController@dell');
Route::post('karyawan/tambah', 'UserController@tambah');
Route::get('karyawan/hapus/{id}', 'UserController@hapus');
Route::post('karyawan/edit/{id}', 'UserController@edit');
Route::post('karyawan/import', 'UserController@import');
// });
