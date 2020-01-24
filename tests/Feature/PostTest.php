<?php


namespace Tests\Feature;


use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase {

	use DatabaseMigrations;

	public function test_user_can_view_post () {
		$post = create(Post::class);
		$this->get($post->path())
			->assertSee($post->title)
			->assertSee($post->content)
			->assertSee($post->creator->name);
	}

	public function test_user_can_create_post () {
		$this->withoutExceptionHandling();
		$this->signIn();
		/** @var Post $post */
		$post = make(Post::class, ['user_id' => auth()->user()->id]);
		$this->get('/posts/create')
			->assertStatus(200);
		$response = $this->post('/posts', $post->toArray());
		$this->get($response->headers->get('Location'))
			->assertSee($post->title)
			->assertSee($post->content);
		$this->assertDatabaseHas('posts', ['title' => $post->title]);
	}

	public function test_post_requires_title () {
		$this->signIn();
		$post = raw(Post::class, ['title' => null]);
		$this->post('/posts', $post)
			->assertSessionHasErrors('title');
	}

	public function test_unauth_user_cannot_create_post () {
		/** @var Post $post */
		$post = make(Post::class);
		$this->get('/posts/create')
			->assertRedirect('/login');
		$this->post($post->path(), $post->toArray())
			->assertRedirect('/login');
		$this->assertDatabaseMissing('posts', ['id' => $post->id]);
	}
}