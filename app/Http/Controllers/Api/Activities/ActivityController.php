<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Activities;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityFilterRequest;
use App\Http\Resources\Activities\ActivityIndexResource;
use App\Http\Resources\Activities\ActivityShowResource;
use App\Models\Activity;
use App\Services\Api\ActivityService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityController extends Controller
{
    public function __construct(
        private readonly ActivityService $activityService
    ) {}

    /**
     * Get Activities
     *
     * Getting the list of the activities
     *
     * @queryParam activity_type string Optional. Filter by activity type. Example: Acrobatics
     * @queryParam session_type string Optional. Filter by session type. Example: Individual
     * @queryParam city string Optional. Filter by city. Example: Vilnius
     * @queryParam start_date date Optional. Filter by start date. Format: YYYY-MM-DD. Example: 2025-06-01
     *
     */
    public function index(ActivityFilterRequest $request): AnonymousResourceCollection
    {
        $activities = $this->activityService->getFilteredActivities($request);

        return ActivityIndexResource::collection($activities);
    }

    /**
     * Get specific activity
     *
     * Getting the specific activity
     */
    public function show(Activity $activity): ActivityShowResource
    {
        return new ActivityShowResource($activity);
    }
}
