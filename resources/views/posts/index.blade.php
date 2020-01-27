<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @var \App\Post                                            $post
 */
?>

@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto">
		@forelse($posts as $post)
			<div class="card">
				<div>
					<a href="{{$post->path()}}">
						{{$post->title}}
					</a>
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
			<div class="w-full max-w-xs content-center mx-auto card">
				<p>
					There are no posts yet!
				</p>
			</div>

		@endforelse
	</div>
@endsection