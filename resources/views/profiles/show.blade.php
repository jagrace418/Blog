<?php
/** @var \App\User $user */
?>

@extends('layouts.app')

@section('content')
	<div>
		<div>
			<div>
				{{--			image here--}}
			</div>
			<div>
				{{$user->name}}
			</div>
		</div>
		@forelse($activities as $date => $activity)
			<h3>{{$date}}</h3>
			@foreach($activity as $record)
				{{--				@if(view()->exists("profiles.activities.{$record->type}"))--}}
				@include("profiles.activities.{$record->type}", ['activity' => $record])
				{{--				@endif--}}
			@endforeach
		@empty
			<p class="text-center">There is no activity yet for this user.</p>
		@endforelse
	</div>
@endsection