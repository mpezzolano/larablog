<!DOCTYPE html>
<html>
<head>
	<title>@yield('titulo')</title>
	<meta charset="utf-8">
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
</head>
<body>
	<div class="container">
		<ul class="breadcrumb">
			@section('navegacion')
				@if(Auth::check())
					<li>Bienvenido {{ Auth::user()->username }}</li>
					<li>{{ HTML::link(URL::to('dashboard'), 'Dahboard') }}</li>
					<li>{{ HTML::link(URL::to('newpost'), 'Crear un post') }}</li>
					<li>{{ HTML::link(URL::to('logout'), 'Logout') }}</li>
				@else
					<li>{{ HTML::link(URL::to('login'), 'Login') }}</li>
					<li>{{ HTML::link(URL::to('register'), 'Registro') }}</li>
				@endif
			@show
		</ul>

		<div class="row">
			@if(Auth::check())
				<div class="col-md-4 well">
					@yield('sidebar')
				</div>
			@endif

			<div class="col-md-8">
				@yield('contenido')
			</div>
		</div>
	</div>
</body>
</html>