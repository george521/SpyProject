<?php

// tests/Feature/SpyCreationTest.php
namespace Tests\Feature;

use App\Models\Spy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RandomSpiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_get_random_spies()
    {
        // Simulate authentication (you may need to create a test user)
        $user = User::factory()->create();
        Spy::createSpy([
            'name' => 'Joe',
            'surname' => 'Doe',
            'agency' => 'CIA',
            'country_of_operation' => 'Greece',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => null,
        ]);
        Spy::createSpy([
            'name' => 'Joe2',
            'surname' => 'Doe2',
            'agency' => 'CIA',
            'country_of_operation' => 'Greece',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => null,
        ]);
        Spy::createSpy([
            'name' => 'Joe3',
            'surname' => 'Doe3',
            'agency' => 'CIA',
            'country_of_operation' => 'Greece',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => null,
        ]);
        Spy::createSpy([
            'name' => 'Joe4',
            'surname' => 'Doe4',
            'agency' => 'CIA',
            'country_of_operation' => 'Greece',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => '2010-01-01',
        ]);
        Spy::createSpy([
            'name' => 'Joe5',
            'surname' => 'Doe5',
            'agency' => 'CIA',
            'country_of_operation' => 'Greece',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => '2006-01-01',
        ]);

        // Simulate API request
        $response = $this->actingAs($user)->postJson('/api/spies/random', [
            'username' => 'admin',
            'password' => 'admin'
        ]);

        $response->assertStatus(200);

    }
}

