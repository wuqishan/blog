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

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/blog', 'IndexController@blog')->name('blog');
    Route::get('/contact', 'IndexController@contact')->name('contact');
    Route::get('/gallery', 'IndexController@gallery')->name('gallery');
    Route::get('/single', 'IndexController@single')->name('single');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::resource('family', 'FamilyController');
    Route::post('photo', 'UploadController@photo')->name('upload.photo');
});
