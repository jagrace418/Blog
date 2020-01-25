<?php
/** @var \App\Post $post */
?>

@extends('layouts.app')

@section('content')
	<div>
		<form action="/posts" method="POST">
			@csrf
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" name="title" id="title" required>
			</div>
			<div class="form-group">
				<label for="content">Content:</label>
				<textarea name="content" id="content" cols="30" rows="10" required></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn">Post</button>
			</div>

			@if(count($errors))
				<ul class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			@endif

		</form>
	</div>
@endsection