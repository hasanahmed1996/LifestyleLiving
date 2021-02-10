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

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//This route protects specfic paths, such as not allowing the user to access the dashboard without a login authorisation.
Route::group(['middleware' => ['auth']], function (){

    //these routes are for general admin facilities
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check_pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'],'/admin/update-pwd', 'AdminController@updatePassword');

    //categories routes for admin
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');

    //products routes for admin
    Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');

});



Route::get('/logout', 'AdminController@logout');

