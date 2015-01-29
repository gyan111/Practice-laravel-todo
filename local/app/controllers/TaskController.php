<?php

class TaskController extends BaseController {

	public function add()
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}

		if (null !== Input::get('name'))
		{
			$validation = Validator::make(Input::all(), Task::$update_task_form_rules);
			if ($validation->fails())
			{
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			$project_field_values = ['id' => Input::get('project_id'), 'user_id' => Auth::id()];

			$project_related_user = Project::where($project_field_values)->get();


			if(!$project_related_user->isEmpty())
			{
				Task::create([
				'name' 		   => Input::get('name'),
				'description'  => Input::get('description'),
			 	'project_id'   => Input::get('project_id'),
			 	]);

			}
			else
			{
				echo "Thank You for trying it";
			}



			//return Redirect::route('login');
			return Redirect::to('tasks/view')->with('add_message', 'New task Added');
		}
		else
		{ 
			$user = User::find(Auth::id());
			$projects = Project::where('user_id', '=', Auth::id())->get();
			$project_options[""] = "--Select Project--";
			foreach ($projects as $projects) {
				$project_options[$projects['id']] = $projects['name'];
			}

			return View::make('tasks.add', ['user' => $user, 'projects' => $project_options]);
		}

	}

	//update a task
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
					'project_id' => Input::get('project_id'),
					'description'  => Input::get('description'),
					'completed' =>	Input::get('completed'),
				 	);
				return Redirect::back()->withInput()->withErrors($messages = $validation->messages())->with('input_data', $input_data);
				//return Redirect::back()->withInput()->withErrors($validation->messages());
				//return Redirect::back()->withInput()->withErrors($messages = $validation->messages());
				
			}

			$project_field_values = ['id' => Input::get('project_id'), 'user_id' => Auth::id()];
			$project_related_user = Project::where($project_field_values)->get();
			//$task_related_to_user = Task::where(['id' => $id, 'project_id' => Input::get('project_id')])->get();


			if(!$project_related_user->isEmpty())
			{
				$task = Task::find($id);

				$task->name = Input::get('name');
				$task->project_id = Input::get('project_id');
				$task->completed = Input::get('completed');
				$task->description  = Input::get('description');

				$task->save();

				return Redirect::to('projects/view/'. Input::get('project_id'))->with('add_message', 'Task Updated');

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
			$task = Task::find($id);

			$projects = Project::where('user_id', '=', Auth::id())->get();
			$project_options[""] = "--Select Project--";
			foreach ($projects as $projects) {
				$project_options[$projects['id']] = $projects['name'];
			}

			return View::make('tasks.update', ['task'=> $task, 'user' => $user, 'projects' => $project_options]);
		}

	}

	//delete a project
	public function delete($project_id, $task_id)
	{
		if(! Auth::check())
		{
			return Redirect::to('login');
		}
		$project_field_values = ['id' => $project_id, 'user_id' => Auth::id()];
		$project_related_user = Project::where($project_field_values)->get();

		if(!$project_related_user->isEmpty())
		{
			$user = Task::find($task_id);

			$user->delete();

			return Redirect::to('projects/view/'. $project_id)->with('add_message', 'Task Deleted');

		}
		else
		{
			echo "Thank You for trying";
		}
		
	}

}