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

    Route::get('/', 'AdminController@index');
    Route::get('/home', 'AdminController@index');
    Route::get('/admin', 'AdminController@index');
    //new client
    Route::get('/admin/new-client', 'AdminController@new_client_form');
    Route::post('/admin/new-client', 'AdminController@new_client_add');
    //edit client
    Route::get('/admin/edit-client/{client}','AdminController@edit_client_form');
    Route::post('/admin/edit-client/{client}','AdminController@edit_client');
    //new project
    Route::get('/admin/new-project/{client?}','AdminController@new_project_form');
    Route::post('/admin/new-project','AdminController@new_project_add');
    //view projects
    Route::get('/admin/view-projects/{client?}','AdminController@view_projects');
    Route::get('/admin/view-project/{project?}','AdminController@view_project');
    //edit project
    Route::get('/admin/edit-project/{project}','AdminController@edit_project_form');
    Route::post('/admin/edit-project/{project}','AdminController@edit_project');
    //new comp
    Route::get('/admin/new-comp/{project}','AdminController@new_comp_form');
    Route::post('/admin/new-comp','AdminController@new_comp');
    //view comps
    Route::get('/view/comp/{id}','CompController@view_comp');
    //client view project
    Route::get('/view/project/{project}','CompController@view_project');
});
