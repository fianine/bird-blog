<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSeeLogin()
    {
        $response = $this->get(route('secret.login'));

        $response->assertSee('Welcome Back!')
                 ->assertSee('Login');
    }

    public function testCannotSeeLogin()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('secret.login'));

        $response->assertRedirect(route('secret.dashboard'));
    }
}
