<?php


namespace Tests\Feature;


use App\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase {

	use DatabaseMigrations;

	/**
	 * @var Post
	 */
	private $post;

	protected function setUp (): void {
		parent::setUp();
		$this->post = create(Post::class);
	}

	public function testUserCanViewPost () {
		$this->get($this->post->path())
			->assertSee($this->post->title)
			->assertSee($this->post->content)
			->assertSee($this->post->creator->name);
	}

	public function testUserCanCreatePost () {
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

	public function testUnauthUserCannotCreatePost () {
		/** @var Post $post */
		$post = make(Post::class);
		$this->get('/posts/create')
			->assertRedirect('/login');
		$this->post($post->path(), $post->toArray())
			->assertRedirect('/login');
		$this->assertDatabaseMissing('posts', ['id' => $post->id]);
	}

	public function testOwnerCanEditPost () {
		$this->signIn($this->post->creator);
		$this->get($this->post->path() . '/edit')->assertStatus(200);
		$this->patch($this->post->path(),
			$attributes = [
				'content' => 'this is some new updated content that isn\'t the old content',
			])
			->assertRedirect($this->post->path());
		$this->assertDatabaseHas('posts', $attributes);
	}

	public function testNonOwnerCannotEditPost () {
		$this->withoutExceptionHandling();
		$this->expectException(AuthorizationException::class);
		$this->signIn();
		$this->get($this->post->path() . '/edit')->assertRedirect(route('home'));
		$this->patch($this->post->path(),
			$attributes = [
				'content' => 'this is some new updated content that isn\'t the old content',
			])
			->assertRedirect($this->post->path());
		$this->assertDatabaseMissing('posts', $attributes);
	}

	public function testUnauthCannotEditPost () {
		$this->withoutExceptionHandling();
		$this->expectException(AuthenticationException::class);
		$this->get($this->post->path() . '/edit')->assertRedirect('/login');
		$this->patch($this->post->path(),
			$attributes = [
				'content' => 'this is some new updated content that isn\'t the old content',
			])
			->assertRedirect('/login');
		$this->assertDatabaseMissing('posts', $attributes);
	}

	public function testOwnerCanDeletePost () {
		$this->signIn($this->post->creator);
		$this->get($this->post->path() . '/delete')
			->assertStatus(200);
		$this->delete($this->post->path())
			->assertRedirect(route('home'));

		$this->assertDatabaseMissing('posts', ['id' => $this->post->id]);

		$this->assertDatabaseMissing('activities', [
			'subject_id'   => $this->post->id,
			'subject_type' => Post::class,
		]);
	}

	public function testNonAuthCannotDeletePost () {
		$this->withoutExceptionHandling();
		$this->expectException(AuthenticationException::class);
		$this->delete($this->post->path())
			->assertRedirect('/login');
		$this->assertDatabaseHas('posts', ['id' => $this->post->id]);
	}

	public function testPostRequiresTitle () {
		$this->signIn();
		$post = raw(Post::class, ['title' => null]);
		$this->post('/posts', $post)
			->assertSessionHasErrors('title');

		$this->actingAs($this->post->creator)
			->patch($this->post->path(), ['title' => null])
			->assertSessionHasErrors('title');
	}


}