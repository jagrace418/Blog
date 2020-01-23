<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller {

	public function show (Post $post) {
		return view('posts.view', compact('post'));
	}
}
