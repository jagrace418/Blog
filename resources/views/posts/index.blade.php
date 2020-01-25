<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @var \App\Post                                            $post
 */
?>

@extends('layouts.app')

@section('content')
	<div>
		@forelse($posts as $post)
			<div class="card">
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
			<hr/>
		@empty
			<p>
				There are no posts yet!
			</p>
		@endforelse
	</div>
@endsection