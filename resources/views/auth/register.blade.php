@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto">
		<form method="POST" action="{{route('register')}}"
			  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
			@csrf
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="name">
					{{__('Name')}}
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
						@error('name') is-invalid @enderror" value="{{old('name')}}"
					   type="text" name="name" id="name" placeholder="Name" required autocomplete="name" autofocus>
				@error('name')
				<span class="invalid-feedback" role="alert">
			    	<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="email">
					{{__('E-Mail Address')}}
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
							@error('email') is-invalid @enderror" value="{{old('email')}}"
					   type="text" name="email" id="email" placeholder="Email" required autocomplete="email">
				@error('email')
				<span class="invalid-feedback" role="alert">
				    <strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="password">
					{{__('Password')}}
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
						@error('password') is-invalid @enderror" autocomplete="new-password"
					   type="password" name="password" id="password" placeholder="Password" required>
				@error('password')
				<span class="invalid-feedback" role="alert">
				    <strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="password-confirm">
					{{__('Confirm Password')}}
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					   type="password" name="password_confirmation" id="password-confirm" autocomplete="new-password"
					   required>
			</div>
			<button class="btn" type="submit">
				{{__('Register')}}
			</button>
		</form>
	</div>
@endsection
