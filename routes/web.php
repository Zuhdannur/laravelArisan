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

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::group(['middleware'=>['auth:web']],function (){

    Route::resource('/', 'DashboardController');

    Route::resource('/pendapatan','PendapatanController');

    Route::resource('/barang','BarangController');
    Route::get('/barang/data/getData','BarangController@getData');

    Route::resource('/jadwal','JadwalController');
});

Route::get('/welcome',function (){
   return view('home');
});
