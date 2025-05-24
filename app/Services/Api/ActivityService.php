<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Http\Requests\ActivityFilterRequest;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ActivityService
{
    public function getFilteredActivities(ActivityFilterRequest $request): Collection
    {
        $query = Activity::query();

        if ($request->has('activity_type')) {
            $query->where('activity_type', $request->activity_type);
        }

        if ($request->has('session_type')) {
            $query->where('session_type', $request->session_type);
        }

        if ($request->has('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('start_date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $query->whereDate('start_date', $date);
        }

        return $query->get();
    }
}
