@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto card">
		<form action="/posts" method="POST">
			@include('posts.form', [
				'post' => new \App\Post(),
				'submitText' => 'Create Post',
				'cancelRoute' => route('home')
			])
		</form>
	</div>
@endsection