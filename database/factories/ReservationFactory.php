<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $debut = $this->faker->dateTimeBetween('-3 months', '+3months');
        return [
            'intitule' => substr($this->faker->paragraph(),0, 250),
            'debut' => $debut,
            'fin' => $this->faker->dateTimeBetween($debut, $this->faker->dateTimeInInterval($debut, '3 hours')),
            'participants' => $this->faker->numberBetween(2, 10),
        ];
    }
}
