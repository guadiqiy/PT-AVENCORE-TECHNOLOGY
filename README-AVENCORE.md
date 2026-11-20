# PT Avencore Technology: Website Dinamis UMKM (Laravel)

Zip ini berisi file kustom project (model, controller, view, migration, seeder, logo).
Folder `vendor`, `artisan`, dll. tidak ikut, jadi project Laravel barunya dibuat dulu, lalu isi zip ini ditimpa di atasnya.

## Cara pasang

1. Buat project Laravel baru:

   ```
   composer create-project laravel/laravel avencore
   cd avencore
   ```

2. Ekstrak zip ini ke dalam folder `avencore`. Kalau muncul pertanyaan file yang sama, pilih **Timpa / Replace** (yang tertimpa hanya `routes/web.php`, `AppServiceProvider.php`, dan `DatabaseSeeder.php`).

3. Buat database kosong bernama `avencore` (lewat phpMyAdmin), lalu ubah `.env`:

   ```
   APP_NAME="PT Avencore Technology"
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=avencore
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Tidak mau pakai MySQL? Biarkan `DB_CONNECTION=sqlite` (bawaan Laravel), kodenya tetap sama.

4. Jalankan:

   ```
   php artisan migrate --seed
   php artisan storage:link
   php artisan serve
   ```

5. Buka http://127.0.0.1:8000

## Akun admin (dari seeder)

- Alamat: http://127.0.0.1:8000/login
- Email: `admin@avencore.test`
- Kata sandi: `password`

Ganti kata sandi ini sebelum website dipakai di luar tugas.

## Pemenuhan ketentuan tugas

| Ketentuan | Letak |
|---|---|
| Project Laravel, jalan dengan `php artisan serve` | langkah pasang di atas |
| 2 tabel berelasi | `categories` dan `services` (`database/migrations`) |
| Model + relasi Eloquent | `app/Models/Category.php` (hasMany), `app/Models/Service.php` (belongsTo) |
| Data lewat Controller | `app/Http/Controllers` |
| Halaman publik (daftar + detail) | `/layanan`, `/layanan/{slug}` |
| Admin CRUD | `/admin/layanan` dan `/admin/kategori` |
| Upload gambar ke `storage/app/public` | folder `services`, lihat `Admin/ServiceController.php` |
| Validasi server (min. 3 aturan) | `required`, `max`, `numeric`, `image`, `mimes`, `exists`, `unique` |
| Responsif | Bootstrap 5 (CDN) + `public/css/avencore.css` |
| Seeder min. 5 data | 3 kategori dan 7 layanan (`database/seeders`) |
| Identitas perusahaan | nama PT, logo, profil usaha, layanan (`resources/views`, `public/images`) |

## Yang perlu disesuaikan

- Alamat, email, dan nomor telepon di `resources/views/contact.blade.php` dan footer (`layouts/app.blade.php`) masih contoh.
- Nomor WhatsApp di `contact.blade.php` (`wa.me/6281200000000`) masih contoh.
- Bootstrap dan font dimuat dari CDN, jadi butuh internet saat membuka website.
