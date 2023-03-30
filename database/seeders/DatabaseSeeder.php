<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(UsersSeeder::class);
        $this->call(SallesSeeder::class);
        $this->call(ActivitesSeeder::class);
        $this->call(MarerielsSeeder::class);
        $this->call(ReservationsSeeder::class);
        $this->call(AccessoiresSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RolesUsersSeeder::class);
    }
}
