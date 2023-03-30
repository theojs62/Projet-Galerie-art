<?php

namespace Database\Seeders;

use App\Models\Salle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SallesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Salle::factory(10)->create();
/*        $json = Storage::disk('local')->get('/json/salles.json');
        $salles = json_decode($json);

        foreach ($salles as $key => $value) {
            Salle::create([
                "nom" => $value->nom,
                "adresse" => $value->adresse,
                "code_postal" => $value->code_postal,
                "ville" => $value->ville
            ]);
        }*/
    }
}
