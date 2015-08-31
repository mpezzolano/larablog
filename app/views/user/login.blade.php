@extends('base.layout')

@section('titulo')
	{{ $title }}
@stop

@section('navegacion')
	@parent
@stop

@section('contenido')
	<h1 class="text-center">Formulario de login</h1><hr>

	@if(Session::has('confirm'))
		<div class="alert alert-success col-md-offset-2">
			{{ Session::get('confirm') }}
		</div>
	@endif

	@if(Session::has('logout'))
		<div class="alert alert-success col-md-offset-2">
			{{ Session::get('logout') }}
		</div>
	@endif

	@if(Session::has('error_login'))
		<div class="alert alert-danger col-md-offset-2">
			{{ Session::get('error_login') }}
		</div>
	@endif

	<div class="col-md-10 col-md-offset-2">
		{{ Form::open(array('url' => 'login')) }}
		
			<div class="form-group">
				{{ Form::label('email', 'Email') }}
				{{ Form::email('email', Input::old('email'), array("class" => "form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', array("class" => "form-control")) }}
			</div>

			{{ Form::submit('Iniciar sesión', array("class" => "btn btn-success")) }}

		{{ Form::close() }}
	</div>
@stop

