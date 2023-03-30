<?php

namespace Database\Seeders;

use App\Models\Activite;
use App\Models\Materiel;
use App\Models\Salle;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarerielsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create('fr_FR');
        $salle_ids = Salle::all()->pluck('id');

        foreach ($salle_ids as $id) {
            $nbMateriels = $faker->numberBetween(2, 30);
            $materiels = Materiel::factory($nbMateriels)->make();
            foreach ($materiels as $materiel) {
                $materiel->salle_id = $id;
                $materiel->save();
            }
        }
    }
}
