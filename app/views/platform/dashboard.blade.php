@extends('base.layout')

@section('titulo')
{{ $title }}
@stop

@section('navegacion')
    @parent
@stop

@section('contenido')
	@if(Session::has('createPost'))
		<div class="alert alert-success">
			{{ Session::get('createPost') }}
		</div>
	@endif

	<div class="well">
		@if(!$posts->isEmpty())
			@foreach($posts as $post)
				<div class="panel panel-info">
					<div class="panel-heading">
						<p>Autor: {{ $post->user->username }}</p>
					</div>
					<div class="panel-body">
						<p>Título: {{ $post->title }}</p>
					</div>
					<div class="panel-footer">
						{{ HTML::link(URL::to('post/'.$post->id), "Más información") }}
					</div>
				</div>
			@endforeach

			@if($posts->getTotal() > 4)
				<div class="pagination">
					{{ $posts->links() }}
				</div>	
			@endif
		@else
			{{ HTML::link(URL::to('newpost'), '¡Sé el primero en crear un post!') }}
		@endif
	</div>
@stop

@section('sidebar')
	<p>Bienvenido al blog {{ Auth::user()->username }}</p>
@stop
 