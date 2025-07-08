<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direction;
use App\Models\SousDirection;
use App\Models\Service;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directions = Direction::getDefaulDirections();

        foreach ($directions as $directionData) {
            Direction::updateOrCreate(
                ['name' => $directionData['name']],
                [
                    'name' => $directionData['name'],
                ]
            );
        }

        Service::create([
            'name' => 'Aucun'
        ]);

        SousDirection::create([
            'name' => 'Aucun'
        ]);
    }
}

