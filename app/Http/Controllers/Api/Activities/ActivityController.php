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
     * Get a list of available activities. You can optionally filter results by activity type, session type, city, and start date.
     *
     * @queryParam activity_type string Filter by activity type (Acrobatics, Athletics, Pilates, Dances). Example: Dances
     * @queryParam session_type string Filter by session type (Group, Individual, Remote). Example: Group
     * @queryParam city string Filter activities by city name. Example: Vilnius
     * @queryParam start_date date Filter activities by start date (Y-m-d format). Example: 2024-03-21
     *
     * @responseField id int The ID of the activity.
     * @responseField activity_type string The type of the activity.
     * @responseField session_type string The type of the session (Group/Individual).
     * @responseField name string The name of the activity.
     *
     * @response scenario=success {
     *   "data": [
     *     {
     *       "id": 1,
     *       "activity_type": "Dances",
     *       "session_type": "Group",
     *       "name": "Šokiai kam per 50",
     *       "address": "Gedimino pr. 99",
     *       "city": "Vilnius",
     *       "price": "25.00",
     *       "rating": 4.5,
     *       "start_date": "2024-03-21 18:00",
     *       "latitude": "54.68733700",
     *       "longitude": "25.27941500"
     *     }
     *   ]
     *  }
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
     *
     * @urlParam id integer required The ID of the activity. Example: 1
     *
     */
    public function show(Activity $activity): ActivityShowResource
    {
        return new ActivityShowResource($activity);
    }
}
