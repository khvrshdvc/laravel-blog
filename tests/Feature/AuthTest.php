<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/authenticate', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_remember_me_sets_remember_cookie(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/authenticate', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => 'on',
        ]);

        $response->assertCookie(Auth::guard()->getRecallerName());
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $response = $this->from('/login')->post('/authenticate', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_is_throttled_per_email(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/authenticate', ['email' => 'victim@example.com', 'password' => 'wrong']);
        }

        $this->post('/authenticate', ['email' => 'victim@example.com', 'password' => 'wrong'])
            ->assertStatus(429);
    }

    public function test_register_logs_user_in_and_redirects_home(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
}
