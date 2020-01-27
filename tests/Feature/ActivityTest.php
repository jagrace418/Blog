<?php


namespace Tests\Feature;


use App\Activity;
use App\Post;
use Carbon\Carbon;
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

	public function testUserActivityFeed () {
		$this->signIn();

		create(Post::class, [
			'user_id' => auth()->id()
		]);

		create(Post::class, [
			'user_id'    => auth()->id(),
			'created_at' => Carbon::now()->subWeek(),
		]);

		auth()->user()->activity()->first()->update([
			'created_at' => Carbon::now()->subWeek()
		]);

		$feed = Activity::feed(auth()->user());

		self::assertTrue($feed->keys()->contains(
			Carbon::now()->format('Y-m-d')
		));

		self::assertTrue($feed->keys()->contains(
			Carbon::now()->subWeek()->format('Y-m-d')
		));
	}
}