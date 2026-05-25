<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Oase Sastra',
                'password' => Hash::make('1111'),
                'role' => 'admin',
            ]
        );

        // 2. Memanggil BookSeeder
        $this->call([
            BookSeeder::class,
        ]);
    }
}