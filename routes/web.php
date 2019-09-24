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
    return view('user.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?' );

//show all blog post
Route::get('/blog_post','BlogController@all_blog');
Route::get('/single_blog/{id}','BlogController@show');
Route::get('/blog_category','BlogController@blog_category');
Route::get('/post_by_catid/{id}','BlogController@postByCat');
Route::get('/search_post','BlogController@search');
Route::get('/latest_post','BlogController@latestpost');

Route::group(['middleware' => 'auth'], function () {
    //Category routes
    Route::post('/category-new','CategoryController@store');
    Route::get('/category_list','CategoryController@index');
    Route::get('/delete_category/{id}','CategoryController@destroy');
    Route::get('/category_edit/{id}','CategoryController@edit');
    Route::post('/category-update/{id}','CategoryController@update');
    Route::delete('/deletecategory/{id}','CategoryController@delete_cat');

    //Post Routes
    Route::get('/post_list','PostController@index');
    Route::post('/post_new','PostController@store');
    Route::delete('/post_delete/{id}','PostController@destroy');
    Route::get('/post_edit/{id}','PostController@edit');
    Route::post('/post_update/{id}','PostController@update');
});



