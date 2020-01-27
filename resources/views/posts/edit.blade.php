@extends('layouts.app')

@section('content')
	<div class="w-full content-center mx-auto card">
		<form action="{{$post->path()}}" method="POST">
			@method('PATCH')
			@include('posts.form', [
				'post' => $post,
				'submitText' => 'Update Post',
				'cancelRoute' => $post->path(),
			])
		</form>
	</div>
@endsection