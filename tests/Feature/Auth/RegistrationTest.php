<?php

namespace Tests\Feature\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $adminUser = \App\Models\User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($adminUser)->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $adminUser = \App\Models\User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($adminUser)->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'birth_date' => '2000-01-01',
            'address' => 'Test address',
            'phone_number' => '081234567890',
            'role' => 'enum'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
        $response->assertRedirect(route('dashboard'));
    }
}
