<?php

namespace Database\Factories;

use App\Models\StatusLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StatusLog>
 */
class StatusLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['Pending', 'In Transit', 'Delivered']),
            'location' => fake()->city(),
        ];
    }
}
