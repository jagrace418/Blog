<?php


namespace Tests\Feature;


use App\Activity;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase {

	use DatabaseMigrations;

	public function testActivityRecordedOnPostCreate () {
		$this->signIn();
		/** @var Post $post */
		$post = create(Post::class);
		$this->assertDatabaseHas('activities', [
			'type'         => 'created_post',
			'user_id'      => auth()->id(),
			'subject_id'   => $post->id,
			'subject_type' => Post::class,
		]);

		/** @var Activity $activity */
		$activity = Activity::firstOrFail();
		self::assertEquals($activity->subject->id, $post->id);
	}
}