<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ahmad Syaiful Akbar',
            'username' => 'syaiful',
            'password' => Hash::make('12345678'),
            'profile' => 'photo.png',
            'user_level_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'profile' => 'photo.png',
            'user_level_id' => 100,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Directure',
            'username' => 'directure',
            'password' => Hash::make('12345678'),
            'profile' => 'photo.png',
            'user_level_id' => 101,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager',
            'username' => 'manager',
            'password' => Hash::make('12345678'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
