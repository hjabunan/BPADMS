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
        // DB::table('bpa_users')->insert([
        //     'name' => 'Henry Jabunan',
        //     'email' => 'it04@toyotaforklifts-philippines.com',
        //     'idnum' => 'admin',
        //     'password' => Hash::make('Hj@2023!'),
        //     'role' => 0,
        //     'first_time' => 1,
        //     'user_validity' => "",
        //     'status' => 1,
        //     'key' => "550e8400-e29b-41d4-a716-446655440000",
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $users = [
            [
                'name' => 'Henry Jabunan',
                'email' => 'it04@toyotaforklifts-philippines.com',
                'idnum' => 'admin',
                'password' => Hash::make('Hj@2023!'),
                'role' => 0,
                'first_time' => 1,
                'user_validity' => "",
                'status' => 1,
                'key' => "550e8400-e29b-41d4-a716-446655440000",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cherie Lynn Marie Piguerra',
                'email' => 'audit01@toyotaforklifts-philippines.com',
                'idnum' => 'audit01',
                'password' => Hash::make('Cp@2024!'),
                'role' => 0,
                'first_time' => 1,
                'user_validity' => "",
                'status' => 1,
                'key' => "ce3e24f5-5767-4a9e-8f76-91c3ac1d0b1e",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Justin Garingalao',
                'email' => 'audit05@toyotaforklifts-philippines.com',
                'idnum' => 'audit05',
                'password' => Hash::make('Jg@2024!'),
                'role' => 0,
                'first_time' => 1,
                'user_validity' => "",
                'status' => 0,
                'key' => "9d2b0714-bf68-4c5a-b890-6e9bd4f72b8d",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        DB::table('bpa_users')->insert($users);
    }
}
