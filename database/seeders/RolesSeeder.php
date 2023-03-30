<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'nom' => "admin",
        ]);
        Role::factory()->create([
            'nom' => "create_salle",
        ]);
        Role::factory()->create([
            'nom' => "edit_salle",
        ]);
        Role::factory()->create([
            'nom' => "view_salle",
        ]);
        Role::factory()->create([
            'nom' => "visiteur",
        ]);

    }
}

