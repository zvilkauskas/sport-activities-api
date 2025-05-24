<?php

declare(strict_types=1);

namespace App\Http\Resources\Activities;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'activity_type' => $this->activity_type,
            'session_type' => $this->session_type,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'price' => $this->price,
            'rating' => $this->rating,
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d H:i'),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
