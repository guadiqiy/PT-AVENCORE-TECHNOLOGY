<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin untuk masuk ke dashboard
        User::updateOrCreate(
            ['email' => 'admin@avencore.test'],
            ['name' => 'Admin Avencore', 'password' => Hash::make('password')]
        );

        $this->call([
            CategorySeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
