<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $web   = Category::where('name', 'Website & Aplikasi')->first();
        $shop  = Category::where('name', 'E-Commerce')->first();
        $cloud = Category::where('name', 'Cloud & Konsultasi')->first();

        $services = [
            [
                'category_id' => $web->id,
                'name' => 'Website Company Profile',
                'summary' => 'Website resmi usaha Anda: tampil rapi, cepat dibuka, dan nyaman di HP.',
                'description' => "Kami membuat website profil usaha lengkap dengan halaman Beranda, Tentang Kami, Layanan, dan Kontak.\n\nDesain responsif sehingga tampil baik di HP maupun komputer. Konten bisa Anda ubah sendiri lewat dashboard admin, tanpa perlu menghubungi programmer setiap kali ada perubahan.",
                'price' => 2500000,
            ],
            [
                'category_id' => $web->id,
                'name' => 'Sistem Informasi Bisnis',
                'summary' => 'Ganti pencatatan manual dengan sistem yang rapi: stok, pelanggan, dan laporan.',
                'description' => "Cocok untuk usaha yang masih mencatat di buku atau Excel. Kami bangun sistem sesuai alur kerja Anda, misalnya pencatatan stok, data pelanggan, dan laporan penjualan.\n\nData tersimpan aman di satu tempat dan bisa dibuka oleh tim sesuai hak aksesnya masing-masing.",
                'price' => 7500000,
            ],
            [
                'category_id' => $web->id,
                'name' => 'Aplikasi Manajemen Usaha',
                'summary' => 'Aplikasi kustom untuk kasir, pemesanan, atau jadwal kerja tim.',
                'description' => "Punya proses kerja yang belum ada aplikasinya? Kami bantu rancang dan bangun dari awal: mulai dari kasir sederhana, sistem pemesanan, sampai penjadwalan tim.\n\nKami mulai dengan diskusi kebutuhan, lalu Anda bisa mencoba versi awalnya sebelum aplikasi final diserahkan.",
                'price' => 10000000,
            ],
            [
                'category_id' => $shop->id,
                'name' => 'Toko Online',
                'summary' => 'Etalase produk online lengkap dengan keranjang dan pesanan masuk.',
                'description' => "Toko online dengan katalog produk, foto, harga, dan keranjang belanja. Pesanan yang masuk tercatat rapi di dashboard sehingga mudah dipantau.\n\nTampilan dibuat nyaman untuk pembeli yang berbelanja lewat HP.",
                'price' => 4500000,
            ],
            [
                'category_id' => $shop->id,
                'name' => 'Sistem Penjualan Digital',
                'summary' => 'Catat penjualan dari toko dan online dalam satu sistem.',
                'description' => "Gabungkan penjualan dari toko fisik dan online dalam satu sistem. Stok otomatis berkurang saat ada transaksi, dan laporan harian atau bulanan tersedia kapan saja.\n\nCocok untuk UMKM yang ingin tahu produk mana yang paling laku dan kapan harus restock.",
                'price' => 6000000,
            ],
            [
                'category_id' => $cloud->id,
                'name' => 'Cloud Storage & Backup',
                'summary' => 'Data usaha tersimpan aman di cloud dan bisa dipulihkan jika perangkat rusak.',
                'description' => "Kami bantu memindahkan data penting usaha ke penyimpanan cloud, lengkap dengan jadwal backup otomatis.\n\nJika laptop rusak atau hilang, data tetap aman dan bisa dipulihkan. Akses bisa diatur per orang sesuai kebutuhan.",
                'price' => 1500000,
            ],
            [
                'category_id' => $cloud->id,
                'name' => 'Konsultasi Teknologi',
                'summary' => 'Bingung mulai dari mana? Diskusikan kebutuhan digital usaha Anda bersama kami.',
                'description' => "Sesi konsultasi untuk memetakan masalah usaha Anda dan menentukan solusi digital yang paling masuk akal, sesuai anggaran.\n\nAnda akan mendapat ringkasan rekomendasi tertulis yang bisa langsung dijadikan acuan, baik dikerjakan oleh kami maupun pihak lain.",
                'price' => 0,
            ],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(
                ['name' => $s['name']],
                $s + ['slug' => Str::slug($s['name'])]
            );
        }
    }
}
