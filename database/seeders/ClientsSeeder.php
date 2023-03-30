<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $david = User::where('id',1)->first();
        Client::factory()->create([
            'nom' => "Devine",
            'prenom' => "David",
            'adresse' => "Rue de l'Université",
            'code_postal' => "62300",
            'ville' => "Lens",
            'user_id' => $david->id
        ]);
        $users = User::where('id','<>',1)->get();
        foreach ($users as $user){
            $tab = explode(' ',$user->name, 2);
            Client::factory()->create([
                'nom' => $tab[1],
                'prenom' => $tab[0],
                'user_id' => $user->id
            ]);
        }
        Client::factory(4)->create();
    }
}
