<?php
/** @var \App\Post $post */
?>

@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="text-2xl text-center">
			{{$post->title}}
		</div>
		<div>
			{{$post->creator->name}}
		</div>
		<hr/>
		<div>
			{!! $post->content !!}
		</div>
		<div class="mt-4">
			<a class="btn" href="{{$post->path() . '/edit'}}">Edit</a>
			<a class="btn" href="{{$post->path() . '/delete'}}">Delete</a>
		</div>
	</div>
@endsection