<?php

class UserController extends BaseController {

	//Registration of users page
	public function create()
	{
		return View::make('users.create');
	}

	//Storing the user data
	public function store()
	{
		$validation = Validator::make(Input::all(), User::$registration_form_rules);
		if ($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
			
		}

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

			// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
			$filename = Input::get('username');

			//$filename = $file->getClientOriginalName();
			//$extension =$file->getClientOriginalExtension(); 
			$upload_success = Input::file('image')->move($img_dir, $filename);


			// open an image file
			$img = Image::make('uploads/images/'. Input::get('username'));
			//$img = Input::file('image');

			// resize the instance
			$img->resize(240, 240);

			// save the image as a new file
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


	//user dashboard
	public function index()
	{
		$user = User::find(Auth::id());
		$projects = Project::where('user_id', '=', $user->id)->get();
		return View::make('users.dashboard', ['user' => $user, 'projects' => $projects]);
	}

	//user logout
	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');

	}

	//user edit page
	public function edit()
	{
		$user = User::find(Auth::id());
		return View::make('users.update', ['user' => $user, 'input_data' => False ]);

	}

	//update user
	public function update()
	{
		//$validation = Validator::make(Input::all(), User::$update_form_rules);
		$user = User::find(Auth::id());

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
				$update_form_rules['username'] = 'required|unique:users';
			}
			if (Input::get('email') != $user->email)
			{
				$update_form_rules['email'] = 'required|email|unique:users';
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

			
			$projects = Project::where('user_id', '=', $user->id)->get();
			//return View::make('users.dashboard', ['user' => $user, 'projects' => $projects]);
			return Redirect::to('dashboard');
	}

	//editing image
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