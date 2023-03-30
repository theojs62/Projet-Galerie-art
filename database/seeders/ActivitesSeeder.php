<?php

namespace Database\Seeders;

use App\Models\Activite;
use App\Models\Salle;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create('fr_FR');
        $salle_ids = Salle::all()->pluck('id');

        foreach ($salle_ids as $id) {
            $nbActivites = $faker->numberBetween(2, 10);
            $activites = Activite::factory($nbActivites)->make();
            foreach ($activites as $activite) {
                $activite->salle_id = $id;
                $activite->save();
            }
        }
    }
}
