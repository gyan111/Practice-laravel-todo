@extends('templates.dashboard_default')
@section('title')
	Dashboard
@stop

@section('content')
    <div class="col-sm-8">
        <div class="row text-center  ">
            <div class="col-sm-12">
                <br /><br />
                <h2> Project List </h2>
                 <br/>
            </div>
        </div>
          
        @foreach($projects as $project)
        <div class="alert alert-info project_div" id="project_div_{{ $project->id }}">
        	{{ $project -> name}}
        </div>
       	@endforeach
    </div>
@stop