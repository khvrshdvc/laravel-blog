<?php

namespace Tests\Feature;

use App\Events\PostCreated;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Sarlavha',
            'type_body' => 'Laravel',
            'short_body' => 'Xulosa',
            'body' => 'Post matni',
        ], $overrides);
    }

    public function test_guest_cannot_create_post(): void
    {
        $this->post('/posts', $this->validData())->assertRedirect('/login');
    }

    public function test_user_can_create_post_and_event_is_dispatched(): void
    {
        Event::fake([PostCreated::class]);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/posts', $this->validData())
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', ['title' => 'Sarlavha', 'user_id' => $user->id]);
        Event::assertDispatched(PostCreated::class);
    }

    public function test_topic_must_be_from_the_list(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/posts', $this->validData(['type_body' => str_repeat('x', 30)]))
            ->assertSessionHasErrors('type_body');

        $this->assertDatabaseCount('posts', 0);
    }

    public function test_images_with_same_name_do_not_overwrite_each_other(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->post('/posts', $this->validData([
            'image' => UploadedFile::fake()->image('photo.png'),
        ]));
        $this->actingAs($user)->post('/posts', $this->validData([
            'image' => UploadedFile::fake()->image('photo.png'),
        ]));

        [$first, $second] = Post::orderBy('id')->get();
        $this->assertNotEquals($first->image, $second->image);

        $this->actingAs($user)->delete(route('posts.destroy', $first));

        Storage::disk('public')->assertMissing($first->image);
        Storage::disk('public')->assertExists($second->image);
    }

    public function test_create_form_keeps_input_after_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/posts/create')
            ->post('/posts', ['title' => 'T', 'type_body' => 'PHP', 'body' => 'My long body text'])
            ->assertRedirect('/posts/create');

        $this->actingAs($user)
            ->get('/posts/create')
            ->assertSee('>My long body text</textarea>', false)
            ->assertSee('<option value="PHP" selected', false);
    }

    public function test_post_without_image_has_no_broken_image(): void
    {
        $post = Post::factory()->create(['image' => null]);

        $this->get(route('posts.show', $post))->assertDontSee('storage/"', false);
        $this->get(route('posts.index'))->assertDontSee('storage/"', false);
    }

    public function test_only_owner_sees_edit_and_delete_buttons(): void
    {
        $post = Post::factory()->create();

        $this->actingAs(User::find($post->user_id))
            ->get(route('posts.show', $post))
            ->assertSee('btn-edit')
            ->assertSee('btn-delete');

        $this->actingAs(User::factory()->create())
            ->get(route('posts.show', $post))
            ->assertDontSee('btn-edit')
            ->assertDontSee('btn-delete');
    }

    public function test_non_owner_cannot_update_or_delete_post(): void
    {
        $post = Post::factory()->create();
        $other = User::factory()->create();

        $this->actingAs($other)
            ->put(route('posts.update', $post), $this->validData())
            ->assertForbidden();

        $this->actingAs($other)
            ->delete(route('posts.destroy', $post))
            ->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }
}
