<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CanchaSeeder;
use Database\Seeders\TurnoSeeder;
use Database\Seeders\PagoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Llama a los seeders
        $this->call([
            UserSeeder::class,
            CanchaSeeder::class,
            TurnoSeeder::class,
            PagoSeeder::class,
        ]);
    }
}
