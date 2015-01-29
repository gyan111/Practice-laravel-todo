<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<h1>All Users</h1>
	@if ($users)
		@foreach ($users as $user)
			<li>{{ link_to("/users/{$user->username}", $user->username) }}</li>
			<!-- <li>{{ $user -> username }}</li-->
		@endforeach
	@else
		I don't have any record
	@endif
	
</body>
</html>
