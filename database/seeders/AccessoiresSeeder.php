<?php

namespace Database\Seeders;

use App\Models\Materiel;
use App\Models\Reservation;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AccessoiresSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create('fr_FR');
        $reservations = Reservation::all();

        foreach ($reservations as $reservation) {
            $materiel_ids = $reservation->activite->salle->materiels->pluck('id');
            $nbMateriels = $faker->numberBetween(1, count($materiel_ids));
            $selectedMaterielIds = $faker->randomElements($materiel_ids, $nbMateriels);
            $reservation->accessoires()->attach($selectedMaterielIds);
        }
    }
}
