@extends('templates.user_default')

@section('title')
  Login
@stop

@section('content')
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> User Login</h2>
               
                <h5>( Login yourself to get access )</h5>
                <br />
            </div>
        </div>
        <div class="row ">
          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

            @if (Session::get('message'))
                <div class="alert alert-success">
                 {{ Session::get('message') }}
              </div>
            @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                <strong>   Enter Details To Login </strong>  
                    </div>
                    
                    <div class="panel-body">
                        <form role="form" method="post">
                            @if (Session::get('error'))
                              <div class="alert alert-danger">
                               {{ Session::get('error') }}
                            </div>
                          @endif
                            <br />
                            {{ $errors->first('username', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                              <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                              <input type="text" value="{{ Input::old('username') }}" name="username" class="form-control" placeholder="Your Username " />
                            </div>
                            {{ $errors->first('password', '<span class="text-danger">:message</span>') }}
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" name="password" class="form-control"  placeholder="Your Password" />
                            </div>
                            <div class="form-group">
                                <!-- <label class="checkbox-inline">
                                <input type="checkbox" /> Remember me
                                </label> -->
                                <span class="pull-right">
                                    <a href="#" >Forget password ? </a> 
                                </span>
                            </div>
                            {{ Form::submit('Login', array("class" => "btn btn-primary")) }}
                            <hr />
                            Not register ? <a href="register" >click here </a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop