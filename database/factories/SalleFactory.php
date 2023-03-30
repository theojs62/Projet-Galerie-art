<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salle>
 */
class SalleFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'nom' => substr($this->faker->words(2, true), 0, 50),
            'adresse' => $this->faker->streetAddress(),
            'code_postal' => $this->faker->postcode(),
            'ville' => $this->faker->city()
        ];
    }
}
