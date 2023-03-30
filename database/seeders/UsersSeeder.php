<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUsers = ["David","Create","Edit","View","Visiteur"];
        foreach ($listUsers as $user) {
            $nom = $user." Devine";
            $email = strtolower($user)."david.francis@domain.fr";
            User::factory([
                'name' => $nom,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make('secret2'),
                'remember_token' => Str::random(10),
            ])->create();
        }
        User::factory(2)->create();
    }
}
