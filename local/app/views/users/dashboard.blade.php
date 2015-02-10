@extends('templates.dashboard_default')
@section('title')
	Dashboard
@stop

@section('content')
    <div class="col-sm-8 row dashboard">
        <div class="row text-center  ">
            <div class="col-sm-12">
                <br /><br />
                <h2> Project List </h2>
                 <br/>
            </div>
        </div>
        <div class="panel panel-default input_div">
            <div class="panel-heading">
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="name" placeholder="Project Name">
                </div>
                 <div class="cols-sm-3">
                    <button class="btn btn-primary add_project">Add Project</button>
                </div>
            </div>
        </div>
        @foreach($projects as $project)
        <div class="panel panel-default" id="project_main_div_{{ $project->id }}">
            <div class="panel-heading">
            	{{-- $project -> name--}}
                <div class="col-sm-8 project_div"  id="project_div_{{ $project->id }}">
                    <div id="project_name_{{ $project -> id }}">
                        <span id="project_name_span_{{ $project-> id }}">{{ $project -> name}}</span>
                    </div>
                    <div class="project_update_input_div" id="project_update_input_div_{{ $project -> id }}">
                        <input class="form-control" id="project_update_input_{{ $project -> id }}" type="text" name="name" placeholder="Project Name">
                    </div>
                </div>
                 <div class="cols-sm-3">
                    <button class="btn btn-primary update_project" id="update_project_button_{{ $project -> id }}">Update</button>
                    <button class="btn btn-danger delete_project" id="delete_project_button_{{ $project -> id }}">Delete</button>
                </div>
            </div>
            <div class="dasboard_table_panel_body panel-body" id="table_body_{{ $project->id }}">
                <div class="table-responsive">
                    <table class="table table-hover" id="">
                        <thead id="thead_{{ $project->id }}">
                            <tr>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_{{ $project->id }}">
                        </tbody>
                    </table>
                </div>
                <div id="add_task_div_{{ $project->id }}">
                     <div class="col-sm-4">
                        <input class="form-control" id="add_task_name_input_{{ $project->id}}" type="text" name="name" placeholder="Task Name">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" id="add_task_description_input_{{ $project->id}}" type="text" name="description" placeholder="Task Description">
                    </div>
                     <div class="cols-sm-3">
                        <button id="add_task_button_{{ $project->id }}" class="btn btn-info add_task">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop