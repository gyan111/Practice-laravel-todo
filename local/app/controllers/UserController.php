<?php

class UserController extends BaseController {

	//test method
	public function index()
	{

		$users =  User::all();
		return View::make('users.index', ['users' => $users]);

	}

	//test method
	public function show($username)
	{

		$user = User::whereUsername($username)->first();

		return View::make('users.show', ['users' => $user]);
	}

	//test method
	public function create()
	{
		return View::make('users.create');
	}

	//test method
	public function store()
	{
		//return Input::all();
		//return Input::get('username');

		//$validation = Validator::make(Input::all(), ['username' => 'required', 'password' => 'required']);
		$validation = Validator::make(Input::all(), User::$rules);
		if ($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}

		$user = new User;

		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		//return Redirect::to('/users');
		return Redirect::route('users.index');
	}

	//customer login
	public function login()
	{
		if(Auth::check())
		{
			return Redirect::to('dashboard');
		}
		if (null !== Input::get('username'))
		{
			$validator = Validator::make(Input::all(), User::$login_form_rules);
		
			if ($validator->fails()) 
			{
				return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password')); 
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
					return Redirect::to('dashboard');
				} 
				else
				{
					//echo "hi"; die();
					return Redirect::to('login')->with('error', 'Invalid Username or Password')->withInput(Input::except('password'));
				}
			}
		}
		else
		{
			//return View::make('users.index', ['users' => $users]);
			return View::make('users.login');
		}
		
	}

	//registration of customer
	public function register()
	{
		//if (Input::get('username'))
		//echo Input::has('username');
		if (null !== Input::get('username'))
		{
			//return View::make('users.registration');

			//$validation = Validator::make(Input::all(), ['username' => 'required', 'password' => 'required']);
			// $validation = Validator::make(Input::all(), [
			// 										'firstname'	 => 'required|',
			// 										'lastname' 	 => 'required',
			// 										'username' 	 => 'required',
			// 										'email'    	 => 'required|email',
			// 										'country'  	 => 'required',
			// 										'password'	 => 'required|confirmed',
			// 										'confirm_password' => 'required',
			// 										]);
			//echo Input::file('photo')->getFilename();
			//var_dump(Input::file());
			$validation = Validator::make(Input::all(), User::$registration_form_rules);
			if ($validation->fails())
			{
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			//$user = new User;

			// $user->username = Input::get('username');
			// $user->password = Hash::make(Input::get('password'));
			//$user->save();


			if (Input::hasFile('image'))
			{

			    $file = Input::file('image');

				$img_dir = "uploads/images";
	   		    $img_thumb_dir = $img_dir . "/thumbs";

	   		    // // Create folders if they don't exist
		        if (!file_exists($img_dir)) {
		            mkdir($img_dir, 0777, true);
		            mkdir($img_thumb_dir, 0777, true);
		        }

				//$destinationPath = 'images';
				// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
				$filename = Input::get('username');

				//$filename = $file->getClientOriginalName();
				//$extension =$file->getClientOriginalExtension(); 
				$upload_success = Input::file('image')->move($img_dir, $filename);


				// open an image file
				$img = Image::make('uploads/images/'. Input::get('username'));
				//$img = Input::file('image');

				// now you are able to resize the instance
				$img->resize(240, 240);

				// and insert a watermark for example
				//$img->insert('public/watermark.png');

				// finally we save the image as a new file
				$img->save($img_thumb_dir."/" . Input::get('username') . '.jpg');
			}
			else
			{
				$filename = '';
			}
			

			User::create([
				'firstname' => Input::get('firstname'),
				'lastname'  => Input::get('lastname'),
			 	'username'  => Input::get('username'),
			 	'email' 	=> Input::get('email'),
			 	'phone' 	=> Input::get('phone'),
			 	'country' 	=> Input::get('country'),
			 	'password' 	=> Hash::make(Input::get('password')),
			 	'image'     => $filename
			 	]);

			//return Redirect::route('login');
			return Redirect::to('login')->with('message', 'Registration Successful');
		}
		else
		{
			return View::make('users.registration');
		}
	}

	//user dashboard
	public function dashboard()
	{
		if(Auth::check())
		{
			$user = User::find(Auth::id());
			$projects = Project::where('user_id', '=', $user->id)->get();

			return View::make('users.dashboard', ['user' => $user, 'projects' => $projects]);
		}
		else
		{
			return Redirect::to('login');
		}
	}

	//user logout
	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');

	}

	//user edit
	public function update()
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}
		$user = User::find(Auth::id());

		if (null !== Input::get('username'))
		{
			//$validation = Validator::make(Input::all(), User::$update_form_rules);




			$update_form_rules = [
				'firstname'	 		    => 'required',
				'lastname' 	    	    => 'required',
				'username' 	    	    => 'required',
				'email'    	 			=> 'required',
				//'email'    	 			=>'required|email|unique:users,email,' . Input::get['email']
				'country'  	 	  		=> 'required',
				'password'	 	  		=> 'alphaNum|min:3|confirmed',
				//'password_confirmation' => 'Matchpass:'. $postData['password']
			];

			if (Input::get('username') != $user->username)
			{
				$rules['username'] = 'required|unique:users';
			}
			if (Input::get('email') != $user->email)
			{
				$rules['email'] = 'required|email|unique:users';
			}

			$validation = Validator::make(Input::all(), $update_form_rules);

			if ($validation->fails())
			{
				$input_data = array(
					'firstname' => Input::get('firstname'),
					'lastname'  => Input::get('lastname'),
				 	'username'  => Input::get('username'),
				 	'email' 	=> Input::get('email'),
				 	'phone' 	=> Input::get('phone'),
				 	'country' 	=> Input::get('country'),
				 	);
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages())->with('input_data', $input_data);
			}

			$user = User::find($user->id);

			$user->firstname = Input::get('firstname');
			$user->lastname  = Input::get('lastname');
		 	$user->username  = Input::get('username');
		 	$user->email	 = Input::get('email');
		 	$user->phone 	 = Input::get('phone');
		 	$user->country 	 = Input::get('country');

		 	if (Input::get('password') != "")
		 	{
				$user->password = Hash::make(Input::get('password'));		 		
		 	}

			$user->save();

			return Redirect::to('dashboard')->with('message', 'Profile Updated');
		}
		else
		{
			//$user = User::find(Auth::id());
			return View::make('users.update', ['user' => $user, 'input_data' => False ]);
		}

	}

	//editing image
		//user edit
	public function update_image()
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}

		$user = User::find(Auth::id());

		if (Input::hasFile('image'))
		{
			$validation = Validator::make(Input::all(), ['image' => 'required|image']);

			if ($validation->fails())
			{
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

		    $file = Input::file('image');

			$img_dir = "uploads/images";
   		    $img_thumb_dir = $img_dir . "/thumbs";

   		    // // Create folders if they don't exist
	        if (!file_exists($img_dir)) {
	            mkdir($img_dir, 0777, true);
	            mkdir($img_thumb_dir, 0777, true);
	        }

			//$destinationPath = 'images';
			// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
			$filename = $user->username . time();

			//$filename = $file->getClientOriginalName();
			//$extension =$file->getClientOriginalExtension(); 
			$upload_success = Input::file('image')->move($img_dir, $filename);


			// open an image file
			$img = Image::make('uploads/images/'. $user->username . time());
			//$img = Input::file('image');

			// now you are able to resize the instance
			$img->resize(240, 240);

			// and insert a watermark for example
			//$img->insert('public/watermark.png');

			// finally we save the image as a new file
			$img->save($img_thumb_dir."/" . $user->username . time() . '.jpg');
			

			$user = User::find($user->id);

		 	$user->image = $user->id.time();

			$user->save();
			//return Redirect::route('login');

			$user = User::find(Auth::id());
			return View::make('users.update_image', ['user' => $user]);
		}
		else
		{
			$user = User::find(Auth::id());
			return View::make('users.update_image', ['user' => $user]);
		}
	}
}	