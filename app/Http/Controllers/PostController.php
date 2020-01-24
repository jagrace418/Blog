<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PostController extends Controller {

	/**
	 * PostController constructor.
	 */
	public function __construct () {
		$this->middleware('auth')
			->except(['show']);
	}

	/**
	 * @param Post $post
	 *
	 * @return Factory|View
	 */
	public function show (Post $post) {
		return view('posts.view', compact('post'));
	}

	/**
	 * @return Factory|View
	 */
	public function create () {
		return view('posts.create');
	}

	/**
	 * @param PostRequest $request
	 *
	 * @return RedirectResponse|Redirector
	 */
	public function store (PostRequest $request) {
		$post = Post::create(
			$request->validated()
			+ ['user_id' => auth()->user()->id]
		);

		return redirect($post->path());
	}
}
