<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12341234'),
            'email' => 'admin@admin.com',
            'no_hp' => '082326281809',
            'role' => 'admin'
        ]);
    }
}
