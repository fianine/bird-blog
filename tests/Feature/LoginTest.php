<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('secret.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function testLogout()
    {
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('page.home'));
    }
}
