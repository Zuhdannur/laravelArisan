<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/getToken','ApiPegawaiController@get_token');
Route::post('/getProfile','ApiPegawaiController@get_profile');
Route::post('/getDetail','ApiPegawaiController@get_detail_transaksi');

//get Data
Route::get('/getDetailPendapatan/{id}','ApiPegawaiController@getDetailPendapatan');
Route::get('/getDetailPengeluaran/{id}','ApiPegawaiController@getDetailPengeluaran');
Route::get('/barang/{id}','ApiPegawaiController@getBarang');


Route::post('/register','ApiPegawaiController@register');