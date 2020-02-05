<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Blog') }}</title>
	<script src="{{ asset('js/app.js') }}" defer></script>
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<script src="https://cdn.tiny.cloud/1/{{env('TINY_API_KEY')}}/tinymce/5/tinymce.min.js"
			referrerpolicy="origin"></script>
	<script>
        tinymce.init({
            selector: '.wysiwyg',
            menubar: false,
            mode: 'exact',
        });
	</script>

</head>
<body>
<div id="app">

	<div class="flex p-3 shadow">
		<div>
			<a href="{{ route('home') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
		</div>
		<!-- Left Side Of Navbar -->
		<div class="flex">
			<div class="nav-item">
				<a id="viewPosts" class="nav-link" href="/posts">
					View Posts
				</a>
			</div>
			@auth()
				<div class="nav-item">
					<a id="createPost" class="nav-link" href="/posts/create">
						Create Post
					</a>
				</div>
			@endauth
		</div>
		<!-- Right Side Of Navbar -->
		<div class="flex">
			@guest
				<div class="nav-item">
					<a class="nav-link" href="{{route('login')}}">
						{{__('Login')}}
					</a>
				</div>
				@if(Route::has('register'))
					<div class="nav-item">
						<a class="nav-link" href="{{route('register')}}">
							{{__('Register')}}
						</a>
					</div>
				@endif
			@else
				<div class="nav-item">
					<a class="nav-link" href="{{route('profile', Auth::user())}}">
						My Profile
					</a>
				</div>
				<div class="nav-item">
					<a class="nav-link" href="{{route('logout')}}"
					   onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{__('Logout')}}
					</a>
					<form id="logout-form" action="{{route('logout')}}" method="POST"
						  style="display: none;">
						@csrf
					</form>
				</div>
			@endguest

		</div>

	</div>

	<main class="py-4">
		@yield('content')
	</main>
</div>
</body>
</html>
