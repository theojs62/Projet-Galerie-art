<?php

namespace Database\Seeders;

use App\Models\Activite;
use App\Models\Client;
use App\Models\Reservation;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create('fr_FR');
        $activite_ids = Activite::all()->pluck('id');
        $client_ids = Client::all()->pluck('id');

        foreach ($client_ids as $client_id) {
            $nbActivites = $faker->numberBetween(1, 10);
            $reservations = Reservation::factory($nbActivites)->make();
            foreach ($reservations as $reservation) {
                $reservation->activite_id = $faker->randomElement($activite_ids);
                $reservation->client_id = $client_id;
                $reservation->save();
            }
        }
    }
}
