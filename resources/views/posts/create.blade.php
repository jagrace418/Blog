@extends('layouts.app')

@section('content')
	<div class="content-center mx-auto">
		<form class="px-20" action="/posts" method="POST">
			@include('posts.form', [
				'post' => new \App\Post(),
				'submitText' => 'Create Post',
				'cancelRoute' => route('home')
			])
		</form>
	</div>
@endsection