@extends('templates.user_default')

@section('title')
  Reset Password
@stop

@section('content')
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Reset Password</h2>
               
                <h5>( Reset yourself Password )</h5>
                <br />
            </div>
        </div>
        <div class="row ">
          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>   Enter email to get the link to reset password </strong>  
                    </div>
                    
                    <div class="panel-body">
                        {{-- Form::open(['action' => 'RemindersController@postRemind']) --}}
                        <form action="{{ action('RemindersController@postRemind') }}" method="POST">
                            {{ $errors->first('email', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                {{ Form::text('email', Input::old('email'), ["class" => "form-control", "placeholder" => "Your Email"]) }}
                            </div>
                            {{ Form::submit('Send Email', array("class" => "btn btn-primary")) }}
                            <hr />
                            Back to Login ? <a href="{{ Request::root() }}/login" >click here </a> 
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop