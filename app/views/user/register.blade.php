@extends('base.layout')

@section('titulo')
	{{ $title }}
@stop

@section('navegacion')
	@parent
@stop

@section('contenido')
	<h1 class="text-center">Formulario de registro</h1><hr>

	@if($errors->has())
		<div class="alert alert-danger col-md-2-offset">
			@foreach ($errors->all('<p>:message</p>') as $message)
			    {{ $message }}
			@endforeach	 
		</div>	
	@endif
	
	<div class="col-md-10 col-md-offset-2">
		{{ Form::open(array('url' => 'register')) }}
		
			<div class="form-group">
				{{ Form::label('email', 'Email') }}
				{{ Form::email('email', Input::old('email'), array("class" => "form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::label('username', 'Nombre de usuario') }}
				{{ Form::text('username', Input::old('username'), array("class" => "form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', array("class" => "form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::label('password_confirmation', 'Confirma el password') }}
				{{ Form::password('password_confirmation', array("class" => "form-control")) }}
			</div>

			{{ Form::submit('Regístrarme', array("class" => "btn btn-success")) }}

		{{ Form::close() }}
	</div>
@stop