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
}