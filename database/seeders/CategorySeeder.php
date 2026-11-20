<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Website & Aplikasi', 'description' => 'Website profil, sistem informasi, dan aplikasi bisnis yang dibuat sesuai kebutuhan usaha Anda.'],
            ['name' => 'E-Commerce', 'description' => 'Toko online dan sistem penjualan digital agar produk Anda bisa dibeli kapan saja.'],
            ['name' => 'Cloud & Konsultasi', 'description' => 'Penyimpanan data berbasis cloud dan pendampingan menentukan solusi teknologi yang tepat.'],
        ];

        foreach ($categories as $c) {
            Category::updateOrCreate(
                ['name' => $c['name']],
                $c + ['slug' => Str::slug($c['name'])]
            );
        }
    }
}
