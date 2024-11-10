<?php

// tests/Feature/SpyCreationTest.php
namespace Tests\Feature;

use App\Application\Commands\CreateSpyCommand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use App\Events\SpyCreated;
use Tests\TestCase;

class SpyCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_create_spy()
    {
        // Simulate authentication (you may need to create a test user)
        $user = User::factory()->create();

        // Simulate API request
        $response = $this->actingAs($user)->postJson('/api/spies', [
            'username' => 'admin',
            'password' => 'admin',
            'firstname' => 'Test22',
            'surname' => 'Ted22',
            'agency' => 'CIA',
            'date_of_birth' => '1960-01-01',
            'country_of_operation' => 'United States',
        ]);

        $response->assertStatus(201);

        // Verify that a spy has been created in the database
        $this->assertDatabaseHas('spies', [
            'name' => 'Test22',
            'surname' => 'Ted22',
            'agency' => 'CIA',
        ]);

        // Check that the event was fired
        //Event::assertDispatched(SpyCreated::class);
    }
}

