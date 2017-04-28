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

Route::get('/','Home\IndexController@index');

Route::post('/count','Home\IndexController@countArt');


Route::get('/list/{cate_id}','Home\IndexController@cate');

Route::get('/tags/{art_tag}','Home\IndexController@tags');

Route::get('/new/{art_id}','Home\IndexController@news');

Route::any('admin/login', 'Admin\LoginController@login');

Route::any('admin/code', 'Admin\ValidateCodeController@create');
Route::any('admin/showcode', 'Admin\ValidateCodeController@index');
Route::any('admin/showadmin', 'Admin\LoginController@adminsession');
//Route::any('admin/index', 'Admin\IndexController@index');
//Route::get('admin/info','Admin\IndexController@info');
//Route::get('admin/crypt','Admin\LoginController@crypt');

Route::group(['middleware' => ['admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('quit','LoginController@quit');
    Route::any('pass','IndexController@pass');
    Route::post('cate/changeOrder','CategoryController@changeOrder');
    Route::resource('category','CategoryController');

    Route::resource('article','ArticleController');
    Route::any('upload','CommonController@upload');
    Route::post('article/changeOrder', 'ArticleController@changeOrder');
    Route::post('article/push', 'ArticleController@push');
    Route::post('article/search', 'ArticleController@ArtSearch');

    Route::resource('links','LinksController');
    Route::post('links/changeOrder','LinksController@changeOrder');

    Route::post('navs/changeorder', 'NavsController@changeOrder');
    Route::resource('navs', 'NavsController');

    Route::resource('positions', 'PositionController');

    Route::resource('positionData', 'PositionDataController');
    Route::post('positionData/changeOrder','PositionDataController@changeOrder');

    Route::get('config/putfile', 'ConfigController@putFile');
    Route::post('config/changecontent', 'ConfigController@changeContent');
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::resource('config', 'ConfigController');


    Route::any('backup','ToolController@backup');

    Route::any('refresh','ToolController@refreshHtml');

});








