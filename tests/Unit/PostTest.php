<?php


namespace Tests\Unit;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase {

	use DatabaseMigrations;

	public function test_post_has_creator () {
		$post = create(Post::class);
		self::assertInstanceOf(User::class, $post->creator);
	}

	public function test_post_has_path () {
		$post = create(Post::class);
		self::assertEquals($post->path(), "/posts/{$post->slug}");
	}
}