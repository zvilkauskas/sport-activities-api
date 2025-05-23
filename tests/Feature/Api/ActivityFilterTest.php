<?php

namespace Api;

use App\Http\Requests\ActivityFilterRequest;
use App\Models\Activity;
use App\Services\Api\ActivityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFilterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_filter_by_activity_type()
    {
        Activity::factory()->create(['activity_type' => 'Pilates']);
        Activity::factory()->create(['activity_type' => 'Acrobatics']);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'activity_type' => 'Acrobatics'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(1, $result);
        $this->assertEquals('Acrobatics', $result->first()->activity_type);
    }

    public function test_can_filter_by_session_type()
    {
        Activity::factory()->create(['session_type' => 'Remote']);
        Activity::factory()->create(['session_type' => 'Individual']);
        Activity::factory()->create(['session_type' => 'Group']);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'session_type' => 'Individual'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(1, $result);
        $this->assertEquals('Individual', $result->first()->session_type);
    }

    public function test_can_filter_by_city()
    {
        Activity::factory()->create(['city' => 'Vilnius']);
        Activity::factory()->create(['city' => 'Kaunas']);
        Activity::factory()->create(['city' => 'Alytus']);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'city' => 'Kaunas'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(1, $result);
        $this->assertEquals('Kaunas', $result->first()->city);
    }

    public function test_can_filter_by_start_date()
    {
        Activity::factory()->create(['start_date' => '2025-01-01']);
        Activity::factory()->create(['start_date' => '2025-05-23']);
        Activity::factory()->create(['start_date' => '2025-11-09']);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'start_date' => '2025-11-09'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(1, $result);
        $this->assertEquals('2025-11-09', $result->first()->start_date->format('Y-m-d'));
    }

    public function test_can_filter_by_multiple_fields()
    {
        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Group',
            'city' => 'Vilnius',
        ]);

        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Individual',
            'city' => 'Kaunas',
        ]);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'activity_type' => 'Pilates',
            'session_type' => 'Group',
            'city' => 'Vilnius',
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(1, $result);
        $this->assertEquals('Pilates', $result->first()->activity_type);
        $this->assertEquals('Group', $result->first()->session_type);
        $this->assertEquals('Vilnius', $result->first()->city);
    }

    public function test_can_filter_by_all_fields()
    {
        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Group',
            'city' => 'Vilnius',
            'start_date' => '2025-01-01'
        ]);

        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Individual',
            'city' => 'Kaunas',
            'start_date' => '2025-05-23'
        ]);

        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Remote',
            'city' => 'Vilnius',
            'start_date' => '2025-11-09'
        ]);

        Activity::factory()->create([
            'activity_type' => 'Pilates',
            'session_type' => 'Group',
            'city' => 'Vilnius',
            'start_date' => '2025-01-01'
        ]);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'activity_type' => 'Pilates',
            'session_type' => 'Group',
            'city' => 'Vilnius',
            'start_date' => '2025-01-01'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(2, $result);
        $this->assertEquals('Pilates', $result->first()->activity_type);
        $this->assertEquals('Group', $result->first()->session_type);
        $this->assertEquals('Vilnius', $result->first()->city);
        $this->assertEquals('2025-01-01', $result->first()->start_date->format('Y-m-d'));
    }

    public function test_returns_empty_when_no_activity_found()
    {
        Activity::factory()->create(['city' => 'Vilnius']);

        $request = ActivityFilterRequest::create('/api/activities', 'GET', [
            'city' => 'Kaunas'
        ]);

        $activityService = new ActivityService();

        $result = $activityService->getFilteredActivities($request);

        $this->assertCount(0, $result);
    }
}
