<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_comment(): void
    {
        $post = Post::factory()->create();

        $this->post('/comments', ['post_id' => $post->id, 'body' => 'Salom'])
            ->assertRedirect('/login');

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_user_can_comment(): void
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('posts.show', $post))
            ->post('/comments', ['post_id' => $post->id, 'body' => 'Salom'])
            ->assertRedirect(route('posts.show', $post));

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'body' => 'Salom',
        ]);
    }

    public function test_comment_requires_body_and_existing_post(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/comments', ['post_id' => 999999, 'body' => ''])
            ->assertSessionHasErrors(['post_id', 'body']);

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_only_store_route_exists_for_comments(): void
    {
        $comment = Comment::factory()->create();

        $this->get('/comments')->assertMethodNotAllowed();
        $this->get('/comments/' . $comment->id)->assertNotFound();
    }

    public function test_post_page_shows_comments(): void
    {
        $post = Post::factory()->create();
        Comment::factory()->count(3)->create(['post_id' => $post->id]);

        $this->actingAs(User::factory()->create())
            ->get(route('posts.show', $post))
            ->assertSee('Izohlar (3)');
    }
}
