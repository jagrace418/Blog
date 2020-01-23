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
	</div>
@endsection