@extends('templates.default')

@section('title')
	Users
@stop

@section('content')
	<h1>Hello, {{ $users->username }}</h1>
@stop
