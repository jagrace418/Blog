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
			->except(['show', 'index']);
	}

	/**
	 * @return Factory|View
	 */
	public function index () {
		$posts = Post::all();

		return view('posts.index', compact('posts'));
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

	public function edit (Post $post) {
		return view('posts.edit', compact('post'));
	}

	public function update (PostRequest $request, Post $post) {

		$post->update($request->validated());

		return redirect($post->path());
	}

	public function delete (Post $post) {
		return view('posts.delete', compact('post'));
	}

	public function destroy (Post $post) {
		$post->delete();

		return redirect(route('home'));
	}
}
