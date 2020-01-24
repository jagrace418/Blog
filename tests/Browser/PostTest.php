<?php


namespace Tests\Browser;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase {

	use DatabaseMigrations;
	use WithFaker;

	public function testCreatePost () {
		/** @var Post $post */
		$post = make(Post::class);
		create(User::class);
		$this->browse(function (Browser $browser) use ($post) {
			$browser->loginAs(User::first())
				->visit('/')
				->clickLink('Create Post')
				->type('title', $post->title)
				->type('content', $post->content)
				->press('Post')
				->assertSee($post->title);
		});
	}

	public function testUnauthUserCannotCreatePost () {
		$this->browse(function (Browser $browser) {
			$browser->visit('/home')
				->assertDontSee('Create Post');
		});
	}
}
