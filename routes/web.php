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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/pdf/descargar/', "BormeDownloader@downloadBorme")->name('descargar_pdf');
Route::get('/txt/listar/',  ['as' => 'listar_txt', 'uses' => "BormeDownloader@index"]);
Route::get('/txt/ver/',  ['as' => 'ver_txt', 'uses' => "BormeDownloader@show"]);
Route::get('/txt/descargar/',  ['as' => 'descargar_txt', 'uses' => "BormeDownloader@download"]);
