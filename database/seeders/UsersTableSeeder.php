<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Mulai seed user...');
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@kopajs.co.id'],
            [
                'name' => 'Admin KOP AJS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Kepala Koperasi
        User::updateOrCreate(
            ['email' => 'kepala@kopajs.co.id'],
            [
                'name' => 'Kepala Koperasi',
                'password' => Hash::make('password'),
                'role' => 'kepala',
            ]
        );
        $this->command->info('Seeding user selesai.');
    }
}