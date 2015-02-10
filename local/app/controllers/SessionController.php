<?php

class SessionController extends BaseController {

	//user login
	public function create()
	{
		if(Auth::check())
		{
			return Redirect::to('dashboard');
		}
		return View::make('users.login');
		
	}

	//user login check
	public function store()
	{
		$validator = Validator::make(Input::all(), User::$login_form_rules);
		if ($validator->fails()) 
		{
			return Redirect::back()->withErrors($validator)->withInput(Input::except('password')); 
		} 
		else
		{
			$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);
			
			//if (Auth::attempt(array('username' => Input::get('username'), 'password' => Hash::make(Input::get('password')))))
			if (Auth::attempt($userdata))
			{
				//return Redirect::to('dashboard');
				return Redirect::intended('dashboard');
			} 
			else
			{
				return Redirect::back()->with('error', 'Invalid Username or Password')->withInput(Input::except('password'));
			}
		}
	}

	//user logout
	public function destroy()
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('login');

	}

}