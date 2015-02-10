<?php

class ProjectController extends BaseController {

	//view all projects
	public function index($id = False)
	{
		$user = User::find(Auth::id());

		$projects = Project::where('user_id', '=', $user->id)->get();

		return View::make('projects.view', ['user' => $user, 'projects' => $projects ]);
	}

	//Create a project
	public function create()
	{
		$user = User::find(Auth::id());
		return View::make('projects.add', ['user' => $user]);
	}

	//Insert data into the database
	public function store()
	{
		$validation = Validator::make(Input::all(), Project::$add_project_form_rules);
		if ($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
			
		}

		$user_id = Auth::id();

		// Project::create([
		// 	'name' 		   => Input::get('name'),
		// 	'description'  => Input::get('description'),
		//  	'user_id'  	   => $user_id
		//  	]);

		$Project = new Project;

		$Project->name = Input::get('name');
		$Project->description = Input::get('description');
		$Project->user_id = $user_id;
		$Project->save();

		if (Request::ajax())
		{
			return $Project->id;
		}
		else
		{
			return Redirect::to('projects')->with('add_message', 'Project Added');
		}
		

	}

	//view single project according to url
	public function show($id = False)
	{
		$user = User::find(Auth::id());

		//test if project is associated with the use or not
		$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$tasks = Task::where('project_id', '=', $id)->orderBy('completed')->get();
			$project = project::where('id', '=', $id)->get();
			//var_dump($tasks); die();

			if (Request::ajax())
			{
				echo json_encode($tasks);
			}
			else
			{
				//return Redirect::to('projects')->with('add_message', 'Project Added');
				return View::make('projects.view_task', ['user' => $user, 'tasks' => $tasks, 'project' => $project->toArray()]);
			}

		}
		else
		{
			return View::make('projects.view_task', ['user' => $user, 'tasks' => False]);
		}
	}

	//Show edit form
	public function edit($id)
	{
		$user = User::find(Auth::id());

		//test if project is associated with the use or not
		$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$project = Project::where(['user_id' => $user->id, 'id' => $id])->get();

			return View::make('projects.update', ['project'=> $project->toArray(), 'user' => $user]);
		}
		else
		{
			echo "Sorry the project doesn't exsit or not belongs to You";
		}

		
	}
	

	//update a project
	public function update($id)
	{
		$validation = Validator::make(Input::all(), Project::$add_project_form_rules);
		if ($validation->fails())
		{
			$input_data = array(
				'name' => Input::get('name'),
				'description'  => Input::get('description'),
			 	);
			return Redirect::back()->withInput()->withErrors($messages = $validation->messages())->with('input_data', $input_data);
			
		}

		$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$project = Project::find($id);

			$project->name = Input::get('name');
			$project->description  = Input::get('description');

			$project->save();

			return Redirect::to('projects')->with('add_message', 'Project Updated');

		}
		else
		{
			echo "Sorry the project doesn't exsit or not belongs to You";
		}


	}

	//delete a project
	public function destroy($id)
	{
		$project_field_values = ['id' => $id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$user = Project::find($id);

			$user->delete();

			return Redirect::to('projects')->with('add_message', 'Project Deleted');

		}
		else
		{
			echo "Sorry the project doesn't exsit or not belongs to You";
		}
		
	}

	
	//get the tasks of a project on dashboard page by ajax method

	// public function tasks()
	// {
	// 	$user = User::find(Auth::id());

	// 	//test if project is associated with the use or not
	// 	$project_field_values = ['id' => Input::get('id'), 'user_id' => Auth::id()];
	// 	$project_related_user = Project::where($project_field_values)->get();

	// 	if(!$project_related_user->isEmpty())
	// 	{
	// 		$tasks = Task::where('project_id', '=', Input::get('id'))->get();
	// 		echo json_encode($tasks);
	// 		//var_dump($tasks); die();
	// 		//return View::make('projects.view_task', ['user' => $user, 'tasks' => $tasks]);
	// 	}
	// 	else
	// 	{
	// 		return False;
	// 	}
	// }

	// //adding projects by ajax request

	// public function AddAjax()
	// {
	// 	if(! Auth::check())
	// 	{
	// 		return Redirect::to('login');
	// 	}

	// 	$validation = Validator::make(Input::all(), Project::$add_project_form_rules);
	// 	if ($validation->fails())
	// 	{
	// 		echo "Not added";
			
	// 	}
	// 	else
	// 	{
	// 		$user_id = Auth::id();

	// 		$Project = new Project;

	// 		$Project->name = Input::get('name');
	// 		$Project->description = Input::get('description');
	// 		$Project->user_id = $user_id;
	// 		$Project->save();


	// 		echo $Project->id;

	// 	}

	// }
}	