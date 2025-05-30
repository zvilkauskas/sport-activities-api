<?php

declare(strict_types=1);

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
                        'name' => (string) str($activity->name)->limit(23),
                        'address' => $activity->address,
                        'city' => $activity->city,
                        'price' => $activity->price,
                        'rating' => $activity->rating,
                        'start_date' => $activity->start_date->format('Y-m-d H:i'),
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

    public function test_api_returns_single_activity(): void
    {
        $user = User::factory()->create();
        $activity = Activity::factory()->create();

        $response = $this->actingAs($user)->getJson(route('activities.show', $activity->id));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $activity->id,
                    'activity_type' => $activity->activity_type,
                    'session_type' => $activity->session_type,
                    'name' => $activity->name,
                    'address' => $activity->address,
                    'city' => $activity->city,
                    'price' => $activity->price,
                    'rating' => $activity->rating,
                    'start_date' => $activity->start_date->format('Y-m-d H:i'),
                ]
            ]);
    }
}
