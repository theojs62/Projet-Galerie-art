<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materiel>
 */
class MaterielFactory extends Factory {

    const TYPE = ['Tapis de Course', 'Vélo elliptiques', 'Ballons de Gym', 'Cordes à sauter',
        'Steps', 'Banc de Musculation', 'Ballons de Gym', 'Ballon foot', 'Balle pickleball', 'Raquette pickleball',
        'Balles Tennis', 'Raquette Tennis', 'Raquette Padel', 'Balles Padel'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'designation' => $this->faker->randomElement(MaterielFactory::TYPE),
            'reference' =>$this->faker->uuid(),
            'observation' => substr($this->faker->paragraph(),0,250),
        ];
    }
}
