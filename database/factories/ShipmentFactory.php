<?php

namespace Database\Factories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['Pending', 'In Transit', 'Delivered']);
        return [
            'tracking_number' => strtoupper(fake()->bothify('TRK-#####-???')),
            'sender_name'     => fake()->name(),
            'sender_address'  => fake()->address(),
            'receiver_name'   => fake()->name(),
            'receiver_address'=> fake()->address(),
            'destination_city'=> fake()->city(),
            'status'          => $status,
        ];
    }
}
