<?php

namespace App\Http\Resources\Activities;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityIndexResource extends JsonResource
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
            'name' => str($this->name)->limit(23),
            'address' => $this->address,
            'city' => $this->city,
            'price' => $this->price,
            'rating' => $this->rating,
            'start_date' => $this->start_date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
