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
    Route::resource('/profile','UserProfileController');

    Route::group(['middleware' => 'App\Http\Middleware\PegawaiMiddleware'], function()
    {
        Route::get('/','DashboardController@index_pegawai');
        Route::post('/data/join','DashboardController@join_toko');
    });
    Route::resource('/', 'DashboardController');
    Route::resource('/pendapatan','PendapatanController');

    Route::post('/pendapatan/data/getPrice','PendapatanController@getPrice');

    Route::group(['middleware' => 'App\Http\Middleware\PemilikMiddleware'], function()
    {
        Route::post('/data/code','DashboardController@generateCode');
        Route::get('/pendapatan/data/getData','PendapatanController@getData');


        Route::resource('/pengeluaran','PengeluaranController');
        Route::get('/pengeluaran/data/getData','PengeluaranController@getData');

        Route::resource('/barang','BarangController');
        Route::get('/barang/data/getData','BarangController@getData');

        Route::resource('/jadwal','JadwalController');

        Route::resource('/pegawai','PegawaiController');
        Route::get('/pegawai/data/getData','PegawaiController@getData');

    });

});

Route::get('/welcome',function (){
   return view('home');
});
