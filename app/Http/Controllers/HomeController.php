<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct () {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 * @return Renderable
	 */
	public function index () {
		return view('home');
	}

	/**
	 * @param User $user
	 *
	 * @return Factory|View
	 */
	public function user (User $user) {

		return view('profile', compact('user'));
	}
}
