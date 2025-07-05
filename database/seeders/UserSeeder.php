<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Créer un utilisateur administrateur (DRH)
        User::updateOrCreate(
            ['email' => 'admin@anadec.com'],
            [
                'name' => 'Admin ANADEC',
                'photo' => null, // Vous pouvez ajouter un chemin de photo si vous en avez une par défaut
                'password' => Hash::make('password'), // Mot de passe par défaut
            ]
        );

    }
}

