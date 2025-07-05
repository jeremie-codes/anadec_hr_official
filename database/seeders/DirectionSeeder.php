<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direction;

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
    }
}

