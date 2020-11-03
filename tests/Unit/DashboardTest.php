<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class DashboardTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSeeDashboard()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('secret.dashboard'));

        $response->assertSee('Dashboard');
    }

    public function testCannotSeeDashboard()
    {
        $response = $this->get(route('secret.dashboard'));

        $response->assertRedirect('/login');
    }
}
