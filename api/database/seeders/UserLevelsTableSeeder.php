<?php

namespace Database\Seeders;

use App\Models\UserLevel;
use Illuminate\Database\Seeder;

class UserLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::create([
            'id' => 1,
            'level' => 'super admin'
        ]);

        UserLevel::create([
            'id' => 100,
            'level' => 'admin'
        ]);

        UserLevel::create([
            'id' => 101,
            'level' => 'directure'
        ]);

        UserLevel::create([
            'id' => 102,
            'level' => 'Manager'
        ]);
    }
}
