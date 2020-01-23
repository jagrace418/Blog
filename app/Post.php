<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * App\Post
 * @property-read User $creator
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @mixin Eloquent
 */
class Post extends Model {

	protected $guarded = [];

	/**
	 * Use the slug instead of id for routing
	 * @return string
	 */
	public function getRouteKeyName () {
		return 'slug';
	}


	protected static function boot () {
		parent::boot();

		self::creating(function (Post $post) {
			$post->slug = self::generatePostSlug($post->title);
		});
	}

	/**
	 * Generate a slug based on a string title
	 * Will verify one doesn't already exist and compensate
	 *
	 * @param $title
	 *
	 * @return string
	 */
	protected static function generatePostSlug ($title) {

		$slug = Str::slug($title);
		$count = \DB::table('posts')
			->whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();

		return $count ? "{$slug}-{$count}" : $slug;
	}

	/**
	 * @return BelongsTo
	 */
	public function creator () {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function path () {
		return "/posts/{$this->slug}";
	}
}
