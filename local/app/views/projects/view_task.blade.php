@extends('templates.dashboard_default')
@section('title')
    View Task
@stop

@section('content')
    <div class="col-sm-8">
        <div class="row text-center  ">
            <div class="col-sm-12">
                <br /><br />
                <h2> Tasks List </h2>
                 <br/>
            </div>
        </div>
           
        <div class="col-md-12">
             <!--    Hover Rows  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Taks List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>1</td>
                                        <td><a href="{{ Request::root() }}/tasks/view/{{ $task->id }}">{{ $task->name }}</a></td>
                                        <td><a href="{{ Request::root() }}/tasks/view/{{ $task->id }}">{{ $task->description }}</a></td>
                                        <td>
                                        @if($task->completed == 0)
                                            <button type="button" class="btn btn-default btn-circle"><i class="fa fa-close"></i>
                            </button>
                                        @else
                                        <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>
                            </button>
                            @endif
                                        <td><a class="btn btn-primary" href="{{ Request::root() }}/tasks/update/{{ $task->id }}">update</a></td>
                                        <td><a class="btn btn-danger" href="{{ Request::root() }}/tasks/delete/{{ $task->project_id }}/{{ $task->id }}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>

       
    </div>
@stop