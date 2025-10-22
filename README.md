📚 Sistem Buku

Project ini adalah Technical Testing dari PT Timedoor Indonesia. 

1. Persiapan & Kebutuhan Sistem

Sebelum menjalankan project, pastikan sudah menginstal:

- XAMPP
 (PHP ≥ 8.0 dan MySQL)

- Git

- Composer

2. Instalasi Project
Langkah-langkah:
   1. Clone Repository
        - git clone https://github.com/username/nama-project.git

    2. Masuk ke Folder Project
        - cd sistem_buku

3. Instal Dependensi

- composer install
- npm install


Lalu sesuaikan konfigurasi database di dalam file .env:

DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=

4. Generate Key (Laravel)
- php artisan key:generate

3. Setup Database

Masuk ke phpMyAdmin → buat database baru dengan nama:

- sistem_buku

5. Import File SQL

- Import file SQL yang ada di folder database/sistem_buku.sql.

6. Menjalankan Aplikasi

Jika menggunakan Laravel:

- php artisan serve
