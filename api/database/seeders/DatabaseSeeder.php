<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ParamsTableSeeder::class,
            UserLevelsTableSeeder::class,
            UsersTableSeeder::class,
            ProvinsiTableSeeder::class,
            KabKotaTableSeeder::class,
        ]);
    }
}
