<?php

class TaskController extends BaseController {

	//create a task
	public function create()
	{

		$user = User::find(Auth::id());
		$projects = Project::where('user_id', '=', Auth::id())->get();
		$project_options[""] = "--Select Project--";
		foreach ($projects as $projects) {
			$project_options[$projects['id']] = $projects['name'];
		}

		return View::make('tasks.add', ['user' => $user, 'projects' => $project_options]);
	}

	//store task details
	public function store()
	{
			$validation = Validator::make(Input::all(), Task::$add_task_form_rules);
			if ($validation->fails())
			{
				//echo 'hello'; die();
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			$project_field_values = ['id' => Input::get('project_id'), 'user_id' => Auth::id()];

			$project_related_user = Project::where($project_field_values)->get();


			if(!$project_related_user->isEmpty())
			{
				// Task::create([
				// 'name' 		   => Input::get('name'),
				// 'description'  => Input::get('description'),
			 // 	'project_id'   => project_id,
			 // 	]);

			 	$Task = new Task;

				$Task->name = Input::get('name');
				$Task->description = Input::get('description');
				$Task->project_id = Input::get('project_id');
				$Task->save();

				if (Request::ajax())
				{
					return $Task->id;
				}
				else
				{
					return Redirect::to('projects/' . Input::get('project_id'))->with('add_message', 'New task Added');
				}

			}
			else
			{
				echo "Sorry the project doesn't exsit or not belongs to You";
			}
			

	}


	//display task data in the edit form
	public function edit($id)
	{
		$user = User::find(Auth::id());
		$task = Task::find($id);

		$projects = Project::where('user_id', '=', Auth::id())->get();
		$project_options[""] = "--Select Project--";
		$projects_ids = array();
		foreach ($projects as $projects) {
			$project_options[$projects['id']] = $projects['name'];
			$projects_ids[] = $projects['id'];
		}
		if (in_array($task->project_id, $projects_ids))
		{
			return View::make('tasks.update', ['task'=> $task, 'user' => $user, 'projects' => $project_options]);	
		}
		else{
			echo "Task Not found or not associated with you.";
		}
	}


	//update a task
	public function update($id)
	{
		
		$validation = Validator::make(Input::all(), Task::$update_task_form_rules);

		if ($validation->fails())
		{
			$input_data = array(
				'name' => Input::get('name'),
				'project_id' => Input::get('project_id'),
				'description'  => Input::get('description'),
				'completed' =>	Input::get('completed'),
			 	);
			return Redirect::back()->withInput()->withErrors($messages = $validation->messages())->with('input_data', $input_data);
			
		}

		$projects = Project::where('user_id', '=', Auth::id())->find(Input::get('project_id'));

		if($projects)
		{
			$task = Task::where('project_id', '=', Input::get('project_id'))->find($id);

			$task->name = Input::get('name');
			$task->project_id = Input::get('project_id');
			$task->completed = Input::get('completed');
			$task->description  = Input::get('description');

			$task->save();

			return Redirect::to('projects/'. Input::get('project_id'))->with('add_message', 'Task Updated');

		}
		else
		{
			echo "Sorry the project doesn't exsit or not belongs to You";
		}

	}

	//status update of tasks
	public function updateStatus()
	{

		$projects = Project::where('user_id', '=', Auth::id())->find(Input::get('project_id'));

		if ($projects)
		{
			$task = Task::where( 'project_id', '=', Input::get('project_id'))->find(Input::get('id'));

			$task->completed = Input::get('completed');

			$task->save();

			echo "Success";
		}
		else{
			echo "Task Not found or not associated with you.";
		}
	}

	//delete a task
	public function destroy($id)
	{
		$task = Task::find($id);

		$projects = Project::where('user_id', '=', Auth::id())->get();
		$projects_ids = array();
		foreach ($projects as $projects) {
			$projects_ids[] = $projects['id'];
		}
		if (in_array($task->project_id, $projects_ids))
		{
			$task->delete();

			return Redirect::to('projects/'. $task->project_id)->with('add_message', 'Task Deleted');

		}
		else
		{
			echo "Sorry the task doesn't exsit or not belongs to You";
		}
		
	}

}