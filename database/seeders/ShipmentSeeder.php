<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Seattle', 'Austin', 'Boston'];
        $firstNames = ['Alex', 'Jordan', 'Taylor', 'Sam', 'Chris', 'Morgan', 'Casey', 'Avery'];
        $lastNames = ['Smith', 'Johnson', 'Lee', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore'];
        $streets = ['Main St', 'Oak Ave', 'Maple Rd', 'Pine St', 'Cedar Ln', 'Lakeview Dr'];
        $statuses = ['Pending', 'In Transit', 'Delivered'];

        for ($i = 1; $i <= 50; $i++) {
            $status = $statuses[array_rand($statuses)];
            $destinationCity = $cities[array_rand($cities)];
            $createdAt = now()->subDays(rand(1, 45))->subHours(rand(0, 23));

            $shipment = Shipment::query()->create([
                'tracking_number' => sprintf('TRK-%05d-%s', $i, Str::upper(Str::random(3))),
                'sender_name' => $this->randomFullName($firstNames, $lastNames),
                'sender_address' => sprintf('%d %s', rand(100, 9999), $streets[array_rand($streets)]),
                'receiver_name' => $this->randomFullName($firstNames, $lastNames),
                'receiver_address' => sprintf('%d %s', rand(100, 9999), $streets[array_rand($streets)]),
                'destination_city' => $destinationCity,
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $steps = match ($shipment->status) {
                'In Transit' => ['Pending', 'In Transit'],
                'Delivered' => ['Pending', 'In Transit', 'Delivered'],
                default => ['Pending'],
            };

            if ($shipment->status === 'Delivered' && rand(0, 1)) {
                array_splice($steps, 2, 0, ['In Transit']);
            }

            $time = $shipment->created_at->copy();

            foreach ($steps as $stepStatus) {
                StatusLog::query()->create([
                    'shipment_id' => $shipment->id,
                    'status' => $stepStatus,
                    'location' => $cities[array_rand($cities)],
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);

                $time = $time->copy()->addHours(rand(4, 36));
            }
        }
    }

    private function randomFullName(array $firstNames, array $lastNames): string
    {
        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }
}
