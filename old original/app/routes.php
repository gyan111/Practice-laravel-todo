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

Route::get('/', function()
{
	return View::make('hello');
});


// Route::get('/', 'PagesController@home');
// Route::get('/about', 'PagesController@about');

// Route::get('users', function()
// {
// 	$users = User::all();

// 	$user = User::find(1);

// 	return $user->email;
// });

// Route::get('/', function()
// {
	//$user = DB::table('users')->find(1);
	//$user = DB::table('users')->where('username', "!=", "Jnana")->get();
	//dd($users);
	//$user = User::where('username', '!=', 'Jnana')->get();
	// $user = User::all();
	// return $user;


	// $user = new User;

	// $user->username = "NewUser";

	// $user->password = Hash::make('password');

	// $user->save();

	// User::create([
	// 	'username' => "AnotherUser",
	// 	'password' => Hash::make('password')
	// 	]);

	// $user = User::find(2);

	// $user->username = 'UpdatedName';

	// $user->save();

	// $user = User::find(2);
	// $user->delete();

	// return User::all();
// 	return User::orderBy('username', 'asc')->get();
// });

// Route::get('users', function()
// {
// 	$users = User::all();

// 	//return View::make('users/index')->withUsers($users);
// 	return View::make('users/index', ['users' => $users]);

// });

// Route::get('users/{username}', function($username)
// {
// 	$user = User::whereUsername($username)->first();
// 	return View::make('users/show', ['user' => $user]);
// });

//Route::get('users', 'UserController@index');
//Route::get('users/{username}', 'UserController@show');

Route::resource('users', 'UserController');

//Route::get('authors', 'Authors@index');

Route::match(array('GET', 'POST'), 'login', 'UserController@login');

Route::match(array('GET', 'POST'), 'register', 'UserController@register');
//Route::get('register', 'UserController@register');
//Route::post('register', 'UserController@register');
Route::get('dashboard', 'UserController@dashboard');
Route::get('logout', 'UserController@logout');
//Route::get('update', 'UserController@update');
Route::match(array('GET', 'POST'), 'update', 'UserController@update');

Route::get('projects', 'ProjectController@view');
Route::get('projects/view', 'ProjectController@view');
//Route::get('projects/view/{{}}', 'ProjectController@view');
Route::match(array('GET', 'POST'), 'projects/add', 'ProjectController@add');

//routing 
Route::match(array('GET', 'POST'), 'update-image', 'UserController@update_image');

Route::get('/', function()
{
    return 'Hello World';
});

