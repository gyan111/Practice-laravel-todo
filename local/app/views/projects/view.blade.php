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
                                    <th>Project Description</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $project_number = 1; ?>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project_number++ }}</td>
                                        <td><a href="{{ Request::root() }}/projects/{{ $project->id }}">{{ $project->name }}</a></td>
                                        <td>{{ $project->description }}</td>
                                        <td><a class="btn btn-primary" href="{{ Request::root() }}/projects/{{ $project->id }}/edit">update</a></td>
                                        <td>
                                        {{Form::open(['method'=>'delete','route'=> ['projects.destroy',$project->id ]])}}
                                             <button class="btn btn-danger" type="submit">Delete</button>                      
                                            {{Form::close()}}   
                                        {{-- link_to_route('projects.destroy', 'Delete', $project->id, array('class'=>'btn btn-danger', 'data-method'=>'delete')) --}}</td>
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