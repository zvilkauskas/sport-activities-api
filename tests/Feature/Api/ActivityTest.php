<?php

namespace Tests\Feature\Api;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_api_returns_activities_list(): void
    {
        $user = User::factory()->create();
        $activity = Activity::factory()->create();

        $response = $this->actingAs($user)->getJson(route('activities.index'));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [
                    [
                        'id' => $activity->id,
                        'activity_type' => $activity->activity_type,
                        'session_type' => $activity->session_type,
                        'name' => str($activity->name)->limit(23),
                        'address' => $activity->address,
                        'city' => $activity->city,
                        'price' => $activity->price,
                        'rating' => $activity->rating,
                        'start_date' => $activity->start_date->toJson(),
                    ]
                ]
            ]);
    }

    public function test_api_returns_multiple_activities(): void
    {
        $user = User::factory()->create();
        Activity::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson(route('activities.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
