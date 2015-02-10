@extends('templates.dashboard_default')
@section('title')
    Update project
@stop

@section('content')

    <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Update Project </h2>
                 <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>  Update project </strong>  
                    </div>
                    <div class="panel-body">
                        @if(!empty($project))
                        {{ Form::open(['method' => 'PUT', 'route' => ['projects.update', $project[0]['id']], 'id' => "project_form"]) }}
                                <br/>
                                {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    {{ Form::text('name', $project[0]['name'], ["class" => "form-control", "placeholder" => "Project Name"]) }}
                                </div>
                                {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    {{ Form::text('description', $project[0]['description'], ["class" => "form-control", "placeholder" => "Short Description"]) }}
                                </div>
                                {{ Form::submit('Update', array("class" => "btn btn-success")) }}
                                <hr />
                           {{ Form::close() }}
                        @else
                        <p>Sorry project not found</p>
                        @endif
                    </div>
                   
                </div>
            </div>
        </div>
@stop