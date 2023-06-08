<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Teacher 1',
            'email' => 'teacher@wonde.com',
            'email_verified_at' => now(),
            'password' => Hash::make('teacher1234'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}