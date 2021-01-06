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

        DB::table('users')->insert([
            'name' => 'Manager (Lisa Fitri)',
            'username' => 'lisafitri',
            'password' => Hash::make('karlwig_ica'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Finance (Indra Anjaswara)',
            'username' => 'indraanjas',
            'password' => Hash::make('karlwig_ndro'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager (Rizky Nursandi)',
            'username' => 'rizkybek',
            'password' => Hash::make('wig_bebek'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager (Rivan Launing)',
            'username' => 'rivanlau',
            'password' => Hash::make('wig_rivan'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager (Adita Bayu)',
            'username' => 'user_adit',
            'password' => Hash::make('aditya'),
            'profile' => 'photo.png',
            'user_level_id' => 102,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Direktur',
            'username' => 'rosalina_kwa',
            'password' => Hash::make('Karlwig#1'),
            'profile' => 'photo.png',
            'user_level_id' => 101,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'DD / Admin',
            'username' => 'user_administrator',
            'password' => Hash::make('karlwigabadi1'),
            'profile' => 'photo.png',
            'user_level_id' => 100,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
