@extends('templates.dashboard_default')
@section('Update Profile')
    View Tasks
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
           
        <div class="col-md-12">
             <!--    Hover Rows  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Project List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>1</td>
                                        <td><a href="{{ Request::root() }}/projects/view/{{ $project->id }}">{{ $project->name }}</a></td>
                                        <td><a class="btn btn-primary" href="{{ Request::root() }}/projects/update/{{ $project->id }}">update</a></td>
                                        <td><a class="btn btn-danger" href="{{ Request::root() }}/projects/delete/{{ $project->id }}">Delete</a></td>
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