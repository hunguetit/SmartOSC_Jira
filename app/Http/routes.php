<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin'], function () {
    get('home', 'Admin\AdminController@index');
    get('index', 'Admin\AdminController@index');
    
	Route::resource('project', 'Admin\ProjectController');

    get('project', 'Admin\ProjectController@index');
    post('project', 'Admin\ProjectController@store');
    get('project/{id}', 'Admin\ProjectController@show');
    get('project/create', 'Admin\ProjectController@create');
    get('project/{id}/delete', 'Admin\ProjectController@destroy');
    post('project/{id}/update', 'Admin\ProjectController@update');

    // Route::resource('task/{product_id}', 'Admin\TaskController');
    get('task/{project_id}', 'Admin\TaskController@index');
    post('task/{project_id}', 'Admin\TaskController@store');
    get('task/{project_id}/create', 'Admin\TaskController@create');
    get('task/{project_id}/{id}', 'Admin\TaskController@show');
    get('task/{project_id}/{id}/delete', 'Admin\TaskController@destroy');
    get('task/{project_id}/{id}/edit', 'Admin\TaskController@edit');
    post('task/{project_id}/{id}/update', 'Admin\TaskController@update');

    Route::resource('user', 'Admin\UserController');
    post('user/{id}/update', 'Admin\UserController@update');
    get('user/{id}/delete', 'Admin\UserController@destroy');
});

Route::get('userTask','Admin\UserTaskController@userTask');

Route::group(['prefix' => 'user'], function () {
    get('home', 'User\UserController@index');
    get('index', 'User\UserController@index');
    
    get('task/{user_id}', 'User\TaskController@index');
    get('task/{user_id}/{id}', 'User\TaskController@show');
    get('project/{user_id}/{projectCode}', 'User\TaskController@project');
    post('task/{user_id}/{id}/update', 'User\TaskController@update');

    Route::resource('user', 'User\UserController');
    post('user/{id}/update', 'User\UserController@update');
});