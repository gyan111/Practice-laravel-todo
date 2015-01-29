@extends('templates.default')

@section('title')
	
@stop

@section('content')
	<h1>Create a new user</h1>
	{{ Form::open(['route' => 'users.store']) }}
	{{-- Form::open(['url' => 'users']) --}}
	<div>
		{{ Form::label('username', 'Username: ') }}
		{{ Form::input('text', 'username') }}
		{{ $errors->first('username', '<span class=errors> Username required</span>') }}
	</div>
	<div>
		{{ Form::label('password', 'Password: ') }}
		{{ Form::input('password', 'password') }}
		{{ $errors->first('password') }}
	</div>
	<div>
		{{ Form::submit('Create User') }}
	</div>
	{{ Form::close() }}
@stop