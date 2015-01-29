@extends('templates.dashboard_default')
@section('title')
    Update Task
@stop

@section('content')

    <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Update Task </h2>
                 <br />
            </div>
        </div>
         <div class="row">
               
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>  Update task </strong>  
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ Request::root() }}/tasks/update/{{ $task->id}}" enctype="multipart/form-data">
                            <br/>
                            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ Input::old('name') ? Input::old('name') : $task->name }}" name="name" class="form-control" placeholder="Task Name" />
                            </div>
                            {{ $errors->first('project_id', '<span class="text-danger">:message</span>') }}
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                {{ Form::select('project_id', $projects, Input::old('project_id') ? Input::old('project_id') : $task->project_id, array('class' => 'form-control')) }}
                            </div>
                            {{ $errors->first('completed', '<span class="text-danger">:message</span>') }}
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                <?php $status_list = array('' => '--Selecte Status--', 0 => 'Incomplete', 1 => 'Completed') ?>
                                <?php //echo $task->completed; die();?>
                                {{ Form::select('completed', $status_list, Input::old('completed') ? Input::old('completed') : $task->completed, array('class' => 'form-control')) }}
                            </div>
                            {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ Input::old('description') ? Input::old('description') : $task->description }}" name="description" class="form-control" placeholder="Short Description" />
                            </div>

                            {{ Form::submit('Update', array("class" => "btn btn-success")) }}
                            <hr />
                           
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
@stop