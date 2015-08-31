@extends('base.layout')

@section('titulo')
{{ $title }}
@stop

@section('navegacion')
    @parent
@stop
 

@section('contenido')
	<h1 class="text-center">Formulario para crear nuevos posts</h1>
    @if($errors->has())
        <div class="alert alert-danger">           
            @foreach ($errors->all('<p>:message</p>') as $message)
			    {{ $message }}
			@endforeach				 
        </div>
    @endif

    <div class="form">
		{{ Form::open(array('url' => 'new')) }}
		
			<div class="form-group">
				{{ Form::label('title', 'Título') }}
				{{ Form::text('title', Input::old('title'), array("class" => "form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::label('body', 'Escribe tu post') }}
				{{ Form::textarea('body', Input::old('body'), array("class" => "form-control")) }}
			</div>

			{{ Form::submit('Crear post', array("class" => "btn btn-success")) }}

		{{ Form::close() }}
	</div>
@stop

@section('sidebar')
	<p>Bienvenido al blog {{ Auth::user()->username }}</p>
@stop