@extends('templates.dashboard_default')
@section('Update Profile')
	Dashboard
@stop

@section('content')

	<div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Update Profile</h2>
                 <br />
            </div>
        </div>
         <div class="row">
               
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>  Update profile details </strong>  
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ Request::root() }}/update" enctype="multipart/form-data">
                            <br/>
                            {{ $errors->first('firstname', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ null !== Input::old('firstname') ? Input::old('firstname') : $user->firstname  }}" name="firstname" class="form-control" placeholder="Your First Name" />
                            </div>
                            {{ $errors->first('lastname', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="text" value="{{ null !== Input::old('lastname') ? Input::old('lastname') : $user->lastname }}" name="lastname" class="form-control" placeholder="Your Last Name" />
                            </div>
                            {{ $errors->first('username', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="text" value="{{ null !== Input::old('username') ? Input::old('username') : $user->username }}" name='username' class="form-control" placeholder="Desired Username" />
                            </div>
                            {{ $errors->first('email', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" value="{{ null !== Input::old('email') ? Input::old('email') : $user->email }}" name="email" class="form-control" placeholder="Your Email" />
                            </div>
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                {{Form::text('phone', null !== Input::old('phone') ? Input::old('phone') : $user->phone , array('class' => 'form-control', 'placeholder' => 'Your Phone Number'))}}
                                <!-- <input type="text" class="form-control" placeholder="Your Email" /> -->
                            </div>
                            {{ $errors->first('country', '<span class="text-danger">:message</span>') }}
                             <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                {{ Form::select('country', array('' => '--Select Country--', 'India' => 'India', 'Nepal' => 'Nepal', 'China' => 'China'), null !== Input::old('country') ? Input::old('country') : $user->country , array('class' => 'form-control')) }}
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
                           <!--  <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                {{ Form::file('image', array('class' => 'form-control', 'value' => 'Input::file("photo")')) }}
                                 <!-- <input type="file" value="{{ Input::old('photo') }}" name="photo" class="form-control"/>
                                <!-- Input::file('photo')
                            </div> -->
                            
                            {{ Form::submit('Update', array("class" => "btn btn-success")) }}
                             {{ Form::submit('Cancel', array("class" => "btn btn-warning")) }}
                            <hr />
                           
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
@stop