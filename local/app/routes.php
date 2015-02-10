<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('user', 'UserController');
Route::resource('session', 'SessionController');
Route::controller('password', 'RemindersController');

Route::get('register', ['as' => 'users.register', 'uses' => 'UserController@create']);

Route::get('login', 'SessionController@create');
Route::get('logout', 'SessionController@destroy');

//single link filter
Route::get('dashboard', ['before' => 'auth',
   'uses' => 'UserController@index',
   'as' => 'user.dashboard'
 ]);

//group filter
Route::group(array('before' => 'auth'), function()
{
	Route::get('edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
	Route::post('update', ['as' => 'update', 'uses' => 'UserController@update']);
	Route::resource('projects', 'ProjectController');
	Route::resource('tasks', 'TaskController');

	Route::post('task/status-update', 'TaskController@updateStatus');

	//Route::post('projects/update/{}', ['as' => 'projects.update', 'uses' => 'ProjectController@update']);
	//Route::get('projects/add', ['as' => 'projects.add', 'uses' => 'ProjectController@create']);
	//Route::get('projects', ['as' => 'projects', 'uses' => 'ProjectController@index']);
	//Route::get('projects/{project}', ['as' => 'projects.id', 'uses' => 'ProjectController@show']);

});


Route::match(array('GET', 'POST'), 'update-image', 'UserController@update_image');

Route::get('/', function()
{
    echo "<a href='login'>Please Login Here to Continue</a>";
});


