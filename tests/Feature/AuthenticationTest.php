<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('DH Single Sign-On');
    }

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/dashboard')
            ->assertRedirect('/login');
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'username' => 'mhaziq@hospitalselayang.gov.my',
            'name' => 'Test User',
            'email' => 'mhaziq@hospitalselayang.gov.my',
            'password' => Hash::make('not-used'),
        ]);
    
        $this->actingAs($user);
    
        $this->assertAuthenticatedAs($user);
    
        $this->post('/logout')
            ->assertRedirect('/');
    
        $this->assertGuest();
    }
}
