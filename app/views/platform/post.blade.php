@extends('base.layout')

@section('titulo')
{{ $title }}
@stop

@section('navegacion')
    @parent
@stop
 

@section('contenido')
	<img src="http://placehold.it/700x100" class="img-responsive"><hr>

	<h1><a href="#">{{ $post->title }}</a></h1><hr>
	<p><span class="glyphicon glyphicon-time"></span> Escrito el {{ $post->created_at }}</p>
	<hr>
	<p>{{ $post->body }}</p>

	@if(count($post->comments) > 0)
		<h3 class="headign">Comentarios del post {{ $post->title }}</h3><hr>

		@foreach($post->comments as $comment)
			<div class="panel panel-info">
				<div class="panel-heading">
					<p>Autor del comentario: {{ $comment->user->username }}</p>
				</div>
				<div class="panel-body">
					<p>{{ $comment->comment }}</p>
				</div>
				<div class="panel-footer">
					<span class="glyphicon glyphicon-time"></span> Escrito el {{ $comment->created_at }}
				</div>
			</div>
		@endforeach
	@else
		<p class="alert alert-danger">Actualmente no hay comentarios</p>
	@endif

	<div class="form">
		{{ Form::open(array("url" => "newcomment")) }}
			{{ Form::hidden("postId", $post->id) }}
			<div class="form-group">
                {{ Form::label('comment', 'Escribe tu comentario') }}
                {{ Form::textarea('comment', Input::old('comment'), array("class" => "form-control", "rows" => 5)) }}            
            </div>
            {{ Form::submit('Crear el comentario', array("class" => "btn btn-success")) }}
		{{ Form::close() }}
	</div>

@stop

@section('sidebar')
	<p>Bievenido al blog {{ Auth::user()->username }}</p>
@stop