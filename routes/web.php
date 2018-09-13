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

    Route::get('/login', 'UserController@login')->name('user.login');
    Route::get('/do_login', 'UserController@doLogin')->name('user.do_login');

    Route::get('/', 'IndexController@index')->name('admin.index');

    // 附件
    Route::get('upload/delete/{id}', 'UploadController@delete')->name('upload.delete');
    Route::post('upload', 'UploadController@upload')->name('upload');

    // 分类
    Route::resource('category', 'CategoryController', [
        'parameters' => ['category' => 'category_id']
    ]);

    // 商品
    Route::resource('goods', 'GoodsController', [
        'parameters' => ['goods' => 'goods_id']
    ]);

    // 导入
    Route::resource('goods_import', 'GoodsImportController', [
        'parameters' => ['goods_import' => 'goods_import_id']
    ]);

    // 导出
    Route::resource('goods_export', 'GoodsExportController', [
        'parameters' => ['goods_export' => 'goods_export_id']
    ]);


});
