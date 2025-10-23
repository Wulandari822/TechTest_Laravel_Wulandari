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

<img width="241" height="147" alt="image" src="https://github.com/user-attachments/assets/a871b390-99c3-4ce6-89ab-c07799b21421" />

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

#Dokumentasi Project
1. ERD
   <img width="1131" height="681" alt="Timedoor Backend Programming drawio" src="https://github.com/user-attachments/assets/3b259d59-4c49-43b9-a9e5-55347fd7eb8c" />
   <img width="729" height="827" alt="Timedoor Backend Programming-Fase 2 drawio" src="https://github.com/user-attachments/assets/67e0a6d0-cdde-4827-b72b-be93e0e912eb" />
   <img width="1051" height="787" alt="image" src="https://github.com/user-attachments/assets/1eb08a3f-0d61-4533-8db4-4e0e49ff5db1" />


