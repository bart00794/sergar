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
    return view('index');
});

Route::get('/photos/',"VkPhotos@index");
Route::post('/photos/',"VkPhotos@GetID");
Route::get('/photos/{id}',"VkPhotos@Show")->where('id', '[0-9]+')->name("GetPhotos");

Route::get('/album',"VkAlbum@index");
Route::post('/album',"VkAlbum@GetID");
Route::get('/album/show/{id}',"VkAlbum@Show")->where('id', '[0-9]+')->name("GetAlbums");

Route::get('/album/download/{owner_id}/{album_id}',"VkAlbum@download");
Route::get('/auth/login',"VkAuth@GetToken");



Route::get('/key',"BitrixKeyController@print");