<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Administrator',
                'password'          => "123",
                'role'              => 'admin',
                'nomor_telepon'     => '081234567890',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'member@example.com'],
            [
                'name'              => 'Member',
                'password'          => "123",
                'role'              => 'member',
                'nomor_telepon'     => '081298765432',
                'email_verified_at' => now(),
            ]
        );
    }
}
