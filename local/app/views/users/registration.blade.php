@extends('templates.user_default')

@section('title')
  Registration
@stop

@section('content')
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Registration</h2>
               
                <h5>( Register yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row">
               
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>  New User ? Register Yourself </strong>  
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ Request::root() }}/register" enctype="multipart/form-data">
                            <br/>
                            {{ $errors->first('firstname', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ Input::old('firstname') }}" name="firstname" class="form-control" placeholder="Your First Name" />
                            </div>
                            {{ $errors->first('lastname', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ Input::old('lastname') }}" name="lastname" class="form-control" placeholder="Your Last Name" />
                            </div>
                            {{ $errors->first('username', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="text" value="{{ Input::old('username') }}" name='username' class="form-control" placeholder="Desired Username" />
                            </div>
                            {{ $errors->first('email', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" value="{{ Input::old('email') }}" name="email" class="form-control" placeholder="Your Email" />
                            </div>
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                {{Form::text('phone', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Your Phone Number'))}}
                                <!-- <input type="text" class="form-control" placeholder="Your Email" /> -->
                            </div>
                            {{ $errors->first('country', '<span class="text-danger">:message</span>') }}
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                {{ Form::select('country', array('' => '--Select Country--', 'India' => 'India', 'Nepal' => 'Nepal', 'China' => 'China'), '' , array('class' => 'form-control')) }}
                            </div>
                            {{ $errors->first('password', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" />
                            </div>
                            {{ $errors->first('confirm_password', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                {{ Form::file('image', array('class' => 'form-control', 'value' => 'Input::file("photo")')) }}
                                 <!-- <input type="file" value="{{ Input::old('photo') }}" name="photo" class="form-control"/> -->
                                <!-- Input::file('photo') -->
                            </div>
                            
                            {{ Form::submit('Register Me', array("class" => "btn btn-success")) }}
                            <hr />
                            Already Registered ?  <a href="<?php echo  Request::root();?>/login" >Login here</a>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Form::open(array('url' => 'login', 'method' => 'post')) }}
{{Form::label('email','Email')}}
{{Form::text('email', null,array('class' => 'form-control'))}}
{{Form::label('password','Password')}}
{{Form::password('password',array('class' => 'form-control'))}}
{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
{{ Form::close() --}}