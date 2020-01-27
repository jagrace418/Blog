@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto">
		<form method="POST" action="{{route('login')}}"
			  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
			@csrf
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="email">
					Email
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
						@error('email') is-invalid @enderror"
					   type="text" name="email" id="email" placeholder="Email" autocomplete="email"
					   value="{{old('email')}}" required autofocus>
				@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="password">
					Password
				</label>
				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
						@error('password') is-invalid @enderror"
					   type="password" name="password" id="password" placeholder="Password"
					   autocomplete="current-password"
					   required>
				@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-4">
				<input class="leading-tight mr-2" type="checkbox" name="remember" id="remember"
						{{old('remember') ? 'checked' : ''}}>
				<label class="block text-gray-500 text-sm font-bold mb-2" for="remember">
					{{__('Remember Me')}}
				</label>
			</div>
			<div class="form-group">
				<button class="btn" type="submit">
					{{__('Login')}}
				</button>
				<a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
				   href="{{route('password.request')}}">
					{{__('Forgot Your Password?')}}
				</a>
			</div>
		</form>
	</div>
@endsection
