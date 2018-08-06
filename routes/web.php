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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::'], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::post('photo', 'UploadController@photo')->name('upload.photo');
    Route::get('upload/delete/{id}', 'UploadController@delete')->name('upload.delete');

    Route::resource('family', 'FamilyController');

    // 分类
    Route::resource('category', 'CategoryController');

    // 文章
    Route::resource('article', 'ArticleController');

    // 评论
    Route::get('comment', 'CommentController@index')->name('comment.index');
    Route::post('comment/change_show/{id}', 'CommentController@changeShow')->name('comment.change.show');
});
