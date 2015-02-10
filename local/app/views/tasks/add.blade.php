@extends('templates.dashboard_default')
@section('Update Profile')
    Add a project
@stop

@section('content')

    <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Add Task </h2>
                 <br />
            </div>
        </div>
         <div class="row">
               
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>  Add a new task </strong>  
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'tasks.store', 'id' => "task_form"]) }}
                            <br/>
                            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                {{ Form::text('name', Input::old('name'), ["class" => "form-control", "placeholder" => "Task Name"]) }}
                            </div>
                            {{ $errors->first('project_id', '<span class="text-danger">:message</span>') }}
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                {{ Form::select('project_id', $projects, Input::old('project_id'), array('class' => 'form-control')) }}
                            </div>
                            {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                {{ Form::text('description', Input::old('description'), ["class" => "form-control", "placeholder" => "Short Description"]) }}
                            </div>
                            {{ Form::submit('Add', array("class" => "btn btn-success")) }}
                            <hr />
                           
                        {{ Form::close() }}
                    </div>
                   
                </div>
            </div>
        </div>
@stop