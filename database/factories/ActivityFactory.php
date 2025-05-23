<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type' => fake()->randomElement(['Acrobatics', 'Athletics' , 'Pilates', 'Dances']),
            'session_type' => fake()->randomElement(['Group', 'Individual', 'Remote']),
            'name' => fake()->sentence(3, false),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'price' => fake()->randomFloat(2, 10, 200),
            'rating' => fake()->randomFloat(1, 1, 5),
            'start_date' => fake()->dateTimeBetween('now', '+1 year'),
            'latitude' => fake()->latitude(54.62, 54.75),
            'longitude' => fake()->longitude(25.11, 25.36)
        ];
    }
}
