<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $user = User::all()->pluck('id');
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'adresse' => $this->faker->streetAddress(),
            'code_postal' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'user_id' => $this->faker->randomElement($user),
            'valide'=>$this->faker->boolean()
        ];
    }
}
