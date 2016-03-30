<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/admin', 'AdminController@index');
    //new client
    Route::get('/admin/new-client', 'AdminController@new_client_form');
    Route::post('/admin/new-client', 'AdminController@new_client_add');
    //new project
    Route::get('/admin/new-project/{client?}','AdminController@new_project_form');
    Route::post('/admin/new-project','AdminController@new_project_add');
});
