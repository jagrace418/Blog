<?php
/**
 * @var \App\Post $post
 */
?>
@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto card">
		<form action="{{$post->path()}}" method="POST">
			@method('DELETE')
			@csrf
			<p>Are you sure you would like to delete {{$post->title}} ?</p>
			<div class="form-group">
				<button type="submit" class="btn">Delete</button>
				<a href="{{$post->path()}}">Cancel</a>
			</div>
		</form>
	</div>
@endsection