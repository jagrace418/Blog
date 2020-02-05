@csrf
<div class="form-group md:flex">
	<label class="md:w-1/3" for="title">Title</label>
	<input type="text" name="title" id="title" value="{{$post->title}}" required
		   class="md:w-2/3 form-control shadow-inner appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
</div>
<div class="form-group">
	<label for="content">Content:</label>
	<textarea name="content" id="content" cols="20" rows="15"
			  class="wysiwyg form-control w-full shadow-inner p-4 border-0">{{$post->content}}</textarea>
</div>
<div class="form-group">
	<button type="submit" class="btn">{{$submitText}}</button>
	<a href="{{$cancelRoute}}">Cancel</a>
</div>

@if(count($errors))
	<ul class="alert alert-danger">
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
	</ul>
@endif
