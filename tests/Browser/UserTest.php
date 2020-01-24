<?php


namespace Tests\Browser;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase {

	use DatabaseMigrations;
	use WithFaker;

	public function testCreateUser () {
		$user = create(User::class, [
			'email'    => $this->faker->email,
			'password' => bcrypt('password')
		]);

		$this->browse(function (Browser $browser) use ($user) {
			$browser->visit('/login')
				->type('email', $user->email)
				->type('password', 'password')
				->press('Login')
				->assertSee('logged in!');

			$browser->assertAuthenticatedAs($user);
		});
	}

	public function testRegisterUser () {
		$this->browse(function (Browser $browser) {
			$browser->visit('/register')
				->type('name', $this->faker->name)
				->type('email', $this->faker->email)
				->type('password', 'password')
				->type('password_confirmation', 'password')
				->press('Register')
				->assertSee('logged in!')
				->assertSee('Create Post');
		});
	}
}
