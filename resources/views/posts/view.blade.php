<?php
/** @var \App\Post $post */
?>

@extends('layouts.app')

@section('content')
	<div>
		<div>
			{{$post->title}}
		</div>
		<div>
			{{$post->creator->name}}
		</div>
		<div>
			{{$post->content}}
		</div>
	</div>
@endsection