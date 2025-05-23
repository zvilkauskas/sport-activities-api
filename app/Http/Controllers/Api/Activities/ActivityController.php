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

    public function index(ActivityFilterRequest $request): AnonymousResourceCollection
    {
        $activities = $this->activityService->getFilteredActivities($request);

        return ActivityIndexResource::collection($activities);
    }

    public function show(Activity $activity): ActivityShowResource
    {
        return new ActivityShowResource($activity);
    }
}
