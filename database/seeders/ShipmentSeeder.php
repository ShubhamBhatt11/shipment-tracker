<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipment::factory(50)->create()->each(function ($shipment) {
            // Build a log progression that reflects the shipment's actual status.
            // Pending    → [Pending]
            // In Transit → [Pending, In Transit]  (possibly extra In Transit hops)
            // Delivered  → [Pending, In Transit, Delivered]
            $steps = match ($shipment->status) {
                'In Transit' => ['Pending', 'In Transit'],
                'Delivered'  => ['Pending', 'In Transit', 'Delivered'],
                default      => ['Pending'],   // Pending
            };

            // For In Transit / Delivered, optionally insert an extra
            // "In Transit" hop between the first In Transit and Delivered.
            if ($shipment->status === 'Delivered' && rand(0, 1)) {
                array_splice($steps, 2, 0, ['In Transit']);
            }

            $time = $shipment->created_at->copy();

            foreach ($steps as $status) {
                StatusLog::create([
                    'shipment_id' => $shipment->id,
                    'status'      => $status,
                    'location'    => fake()->city(),
                    'created_at'  => $time,
                    'updated_at'  => $time,
                ]);

                // Advance time by a realistic interval for each leg
                $time = $time->copy()->addHours(rand(4, 36));
            }
        });
    }
}
