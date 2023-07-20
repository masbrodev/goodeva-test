<?php

use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;

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
    return redirect('home');
});
Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes();

Route::get('kategori', 'KategoriController@index');
Route::post('kategori/tambah', 'KategoriController@tambah');
Route::post('kategori/edit/{id}', 'KategoriController@edit');
Route::get('kategori/hapus/{id}', 'KategoriController@hapus');

Route::get('absen', 'AbsenController@index');
Route::get('karyawan', 'UserController@index');
Route::post('karyawan/tambah', 'UserController@tambah');
Route::get('karyawan/hapus/{id}', 'UserController@hapus');
Route::post('karyawan/edit/{id}', 'UserController@edit');





