<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;
use App\Models\User;
use App\Models\Role;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Récupérer les utilisateurs qui n'ont pas encore d'agent associé
        $usersWithoutAgent = User::doesntHave('agent')->get();
        $roles = Role::all();

        // Créer des agents pour les utilisateurs existants sans agent
        foreach ($usersWithoutAgent as $user) {
            Agent::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'matricule' => 'MAT-' . $faker->unique()->randomNumber(5),
                    'nom' => $user->name,
                    'role_id' => $roles->random()->id,
                    'date_naissance' => $faker->dateTimeBetween('-60 years', '-25 years')->format('Y-m-d'),
                    'lieu_naissance' => $faker->city(),
                    'sexe' => 'M',
                    'situation_matrimoniale' => $faker->randomElement(['Célibataire', 'Marié(e)']),
                    'salaire_base' => $faker->randomFloat(2, 500000, 2000000),
                    'date_recrutement' => $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                    'telephone' => $faker->phoneNumber(),
                    'email' => $user->email,
                    'photo' => null,
                    'adresse' => $faker->address(),
                    'compte_bancaire' => $faker->bankAccountNumber(),
                    'banque' => $faker->randomElement(['SGBCI', 'BICICI', 'Ecobank', 'BOA']),
                    'numero_cnps' => $faker->unique()->randomNumber(8),
                    'numero_impots' => $faker->unique()->randomNumber(9),
                    'statut' => 'actif',
                ]
            );
        }
    }
}

