<?php

namespace App\Http\Controllers\Api\Activities;

use App\Http\Controllers\Controller;
use App\Http\Resources\Activities\ActivityIndexResource;
use App\Http\Resources\Activities\ActivityShowResource;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        return ActivityIndexResource::collection(Activity::all());
    }

    public function show(Activity $activity)
    {
        return new ActivityShowResource($activity);
    }
}
