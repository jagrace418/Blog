<?php


namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfileTest extends TestCase {

	use DatabaseMigrations;

	public function testUserHasProfile () {
		$this->signIn();
		/** @var User $user */
		$user = create(User::class);
		$this->get(route('profile', ['user' => $user]))
			->assertSee($user->name);
	}

	public function testGuestCannotViewProfile () {
		/** @var User $user */
		$user = create(User::class);
		$this->get(route('profile', ['user' => $user]))
			->assertRedirect(route('login'));
	}
}