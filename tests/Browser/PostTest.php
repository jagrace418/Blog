<?php


namespace Tests\Browser;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class PostTest extends DuskTestCase {

	use DatabaseMigrations;
	use WithFaker;

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var Post
	 */
	private $post;

	protected function setUp (): void {
		parent::setUp();
		$this->user = create(User::class);
	}

	/**
	 * @throws Throwable
	 */
	public function testCreatePost () {
		/** @var Post $post */
		$post = make(Post::class);
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

	/**
	 * @throws Throwable
	 */
	public function testDeletePost () {
		/** @var Post $post */
		$post = create(Post::class, ['user_id' => User::first()->id]);
		$this->browse(function (Browser $browser) use ($post) {
			$browser->loginAs(User::first())
				->visit($post->path())
				->assertSee($post->title)
				->clickLink('Delete')
				->assertSee('Are you sure')
				->press('Delete')
				->assertRouteIs('home');
		});
		$this->assertDatabaseMissing('posts', ['id' => $post->id]);
	}

	public function testEditPost () {
		/** @var Post $post */
		$post = create(Post::class, ['user_id' => User::first()->id]);
		$updatedContent = 'this is some new content, it should update as such';
		$this->browse(function (Browser $browser) use ($post, $updatedContent) {
			$browser->loginAs(User::first())
				->visit($post->path())
				->assertSee($post->title)
				->clickLink('Edit')
				->assertPathIs($post->path() . '/edit')
				->clear('content')
				->type('content', $updatedContent)
				->press('Update Post')
				->assertPathIs($post->path())
				->assertSee($updatedContent);
		});
		$this->assertDatabaseHas('posts', ['content' => $updatedContent]);
	}

	/**
	 * @throws Throwable
	 */
	public function testUnauthUserCannotCreatePost () {
		$this->browse(function (Browser $browser) {
			$browser->visit('/home')
				->assertDontSee('Create Post');
		});
	}
}
