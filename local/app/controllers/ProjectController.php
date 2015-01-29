<?php

class ProjectController extends BaseController {

	//view single project and all project according to url
	public function view($id = False)
	{
		if ($id)
		{	
			$user = User::find(Auth::id());

			//test if project is associated with the use or not
			$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
			$project_related_user = Project::where($project_field_values)->get();

			if(!$project_related_user->isEmpty())
			{
				$tasks = Task::where('project_id', '=', $id)->get();
				//var_dump($tasks); die();
				return View::make('projects.view_task', ['user' => $user, 'tasks' => $tasks]);
			}
			else
			{
				return View::make('projects.view_task', ['user' => $user, 'tasks' => False]);
			}
			

		}
		else
		{
			$user = User::find(Auth::id());

			$projects = Project::where('user_id', '=', $user->id)->get();

			return View::make('projects.view', ['user' => $user, 'projects' => $projects ]);
		}
	}

	public function add()
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}

		if (null !== Input::get('name'))
		{
			$validation = Validator::make(Input::all(), Project::$add_project_form_rules);
			if ($validation->fails())
			{
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			//$user = new User;

			// $user->username = Input::get('username');
			// $user->password = Hash::make(Input::get('password'));
			//$user->save();


			$user_id = Auth::id();
			//echo $user_id; die();
			Project::create([
				'name' 		   => Input::get('name'),
				'description'  => Input::get('description'),
			 	'user_id'  	   => $user_id
			 	]);

			//return Redirect::route('login');
			return Redirect::to('projects/view')->with('add_message', 'Project Added');
		}
		else
		{
			$user = User::find(Auth::id());

			return View::make('projects.add', ['user' => $user]);
		}

	}

	//update a project
	public function update($id)
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}

		if (null !== Input::get('name'))
		{
			$validation = Validator::make(Input::all(), Project::$add_project_form_rules);
			if ($validation->fails())
			{
				$input_data = array(
					'name' => Input::get('name'),
					'description'  => Input::get('description'),
				 	);
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages())->with('input_data', $input_data);
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				//return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
			$project_related_user = Project::where($project_field_values)->get();

			if(!$project_related_user->isEmpty())
			{
				$project = Project::find($id);

				$project->name = Input::get('name');
				$project->description  = Input::get('description');

				$project->save();

				return Redirect::to('projects/view')->with('add_message', 'Project Updated');

			}
			else
			{
				echo "Thank You for trying";
			}

			
		}
		else
		{
			$user = User::find(Auth::id());
			//$project_field_values = ['user_id' => $user->id, 'project_id' => $id];
			$project = Project::where(['user_id' => $user->id, 'id' => $id])->get();

			return View::make('projects.update', ['project'=> $project->toArray(), 'user' => $user]);
		}

	}

	//delete a project
	public function delete($id)
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}
		$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$user = Project::find($id);

			$user->delete();

			return Redirect::to('projects/view')->with('add_message', 'Project Deleted');

		}
		else
		{
			echo "Thank You for trying";
		}
		
	}

	
	//get the tasks of a project on dashboard page by ajax method

	public function tasks()
	{
		$user = User::find(Auth::id());

		//test if project is associated with the use or not
		$project_field_values = ['id' => Input::get('id'), 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$tasks = Task::where('project_id', '=', Input::get('id'))->get();
			echo json_encode($tasks);
			//var_dump($tasks); die();
			//return View::make('projects.view_task', ['user' => $user, 'tasks' => $tasks]);
		}
		else
		{
			return False;
		}
	}

}	