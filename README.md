Deskripsi

Project ini dibuat sebagai test project menggunakan Laravel 10 dan PHP 8.1.

Fungsi utama project:
- Menampilkan daftar buku beserta rating.
- Menampilkan top 10 author paling populer.
- Memungkinkan user untuk memberi rating pada buku.
- Mendukung filter dan pagination dengan jumlah data per halaman dapat diubah.
- Mendukung export Excel untuk daftar author.

Semua data awal dibuat fake menggunakan Faker:
- 1000 authors
- 3000 categories
- 100.000 books
- 500.000 ratings

Fitur
1. List Buku
   - Filter berdasarkan nama buku atau nama author.
   - Menampilkan buku berdasarkan rata-rata rating tertinggi.
   - Pagination dengan pilihan jumlah data per page (10, 20, 50, 100).
2. Top 10 Author
   - Daftar author dengan vote terbanyak.
3. Input Rating
   - Setiap buku bisa dinilai dengan skala 1–10.
   - Setelah submit rating, akan kembali ke halaman list buku.
4. CRUD Author & Category
   - Tambah, edit, hapus author dan category.
   - Search pada list author dan category.
5. Export
   - Export data author ke file Excel.

Instalasi
# Persyaratan
- PHP >= 8.1
- Composer
- MySQL
- Laravel >= 10

# Langkah Instalasi
1. Clone Repository
   git clone https:[//github.com/username/repo-name.git](https://github.com/Wulandari822/TechTest_Laravel_Wulandari.git)
   cd TechTest_Laravel_Wulandari

2. Install Dependencies
   composer install
3. Isi file .env
4. Generate Key Laravel
   php artisan key:generate
6. Jalankan Migration & Seeder
   php artisan migrate
   php artisan db:seed
7. Jalankan Server Laravel
   php artisan serve

# Dokumentasi Project
1. ERD (Entity Relationship Diagram)
   <img width="1131" height="681" alt="Timedoor Backend Programming drawio" src="https://github.com/user-attachments/assets/3b259d59-4c49-43b9-a9e5-55347fd7eb8c" />
   <img width="729" height="827" alt="Timedoor Backend Programming-Fase 2 drawio" src="https://github.com/user-attachments/assets/67e0a6d0-cdde-4827-b72b-be93e0e912eb" />
2. Struktur Database
   <img width="1051" height="787" alt="image" src="https://github.com/user-attachments/assets/1eb08a3f-0d61-4533-8db4-4e0e49ff5db1" />
3. Dokumentasi Sistem
   - Register
     <img width="1919" height="979" alt="image" src="https://github.com/user-attachments/assets/f52cabc5-d34f-4eee-8fa7-99ac9db1c74a" />
   - Login
     <img width="1919" height="979" alt="image" src="https://github.com/user-attachments/assets/fcb47dc6-2823-4f82-9de7-fcf3f2e2ca88" />
   - Halaman Admin
     - Dashboard
       <img width="1914" height="971" alt="image" src="https://github.com/user-attachments/assets/797eb2fa-fcbc-4ada-b5de-09d6b15b0a4e" />
     - Buku
       <img width="1919" height="971" alt="image" src="https://github.com/user-attachments/assets/57d530bb-8ffb-4160-aa1c-d106a500491d" />
     - Tambah Buku
       <img width="1919" height="971" alt="image" src="https://github.com/user-attachments/assets/e1039c34-1c94-4629-8ba2-f254a224a731" />
     - Edit Buku
       <img width="1919" height="968" alt="image" src="https://github.com/user-attachments/assets/aaf865a8-f218-424e-89f9-945fe30475b2" />
     - Tombol Hapus dan Edit
       <img width="1919" height="969" alt="image" src="https://github.com/user-attachments/assets/52271727-c102-4b55-8f13-aa999879ed2e" />
     - Author
       <img width="1919" height="983" alt="image" src="https://github.com/user-attachments/assets/d2696b2d-48ba-4ff1-a71c-3512c7e19329" />
     - Tambah Author
       <img width="1919" height="965" alt="image" src="https://github.com/user-attachments/assets/b98cd09a-572e-40c8-88d5-7f84cd645d9c" />
     - Download Excel
       <img width="1919" height="975" alt="image" src="https://github.com/user-attachments/assets/e3b7a2e1-4565-4c97-b451-add921d218bf" />
     - Edit Author
       <img width="1919" height="974" alt="image" src="https://github.com/user-attachments/assets/8b72aee7-64ba-4cce-874c-5e966938b551" />
     - Search
       <img width="1919" height="922" alt="image" src="https://github.com/user-attachments/assets/8ef3131b-7697-4e1a-aecb-7b4f0285e2f8" />
       <img width="1919" height="977" alt="image" src="https://github.com/user-attachments/assets/2f34aa5b-2280-4f70-831c-822e226ce1e9" />
     - Cateogory
       <img width="1919" height="974" alt="image" src="https://github.com/user-attachments/assets/5672e783-dd4e-405e-accf-bfaf8e868091" />
     - Tambah Category
       <img width="1919" height="979" alt="image" src="https://github.com/user-attachments/assets/fd705a8c-4b24-4e72-b981-307d4e8176ee" />
     - Edit Category
       <img width="1919" height="974" alt="image" src="https://github.com/user-attachments/assets/8112c983-b47d-4a09-9099-abefa54737f6" />
     - Detail Transaksi
       <img width="1919" height="975" alt="image" src="https://github.com/user-attachments/assets/9f9f9746-67de-4d3f-9f72-9278277c293b" />
       <img width="1919" height="977" alt="image" src="https://github.com/user-attachments/assets/36b0fa4d-b787-4127-a28c-4b760d457ede" />
       <img width="1919" height="954" alt="image" src="https://github.com/user-attachments/assets/fb414c3e-8bb1-40e1-86f5-3c4bdf164044" />
       <img width="1918" height="976" alt="image" src="https://github.com/user-attachments/assets/32446c12-dfde-4a3e-be5c-f6384d50c39e" />
   -Halaman User
     - Dashboard
       <img width="1919" height="977" alt="image" src="https://github.com/user-attachments/assets/4745c5fa-4c1b-4990-943d-2da973d839ab" />
     - Buku
       <img width="1919" height="975" alt="image" src="https://github.com/user-attachments/assets/cde6b031-88f2-4899-8df7-60bd6fe1ada3" />
     - Search
       <img width="1919" height="972" alt="image" src="https://github.com/user-attachments/assets/f88f8bb7-aada-4cf7-abc9-465fd4864491" />
       <img width="1919" height="984" alt="image" src="https://github.com/user-attachments/assets/be3291c8-59fd-4838-ab31-c575de279e12" />
     - Form Transaksi
       <img width="1919" height="981" alt="image" src="https://github.com/user-attachments/assets/afe9509b-d4bd-411a-99d5-b3f728485e19" />
       <img width="1919" height="976" alt="image" src="https://github.com/user-attachments/assets/056ec62d-d6bf-4558-9818-d12e7c5faebd" />
     - Rating dilakukan setelah transaksi
       <img width="1919" height="975" alt="image" src="https://github.com/user-attachments/assets/9e42ddf7-11c4-4f04-ac78-aa8c760f5124" />
     - Search Dropdown
       <img width="1919" height="975" alt="image" src="https://github.com/user-attachments/assets/ba4c3987-fb4b-45d7-a4ac-a324fd9bd561" />
     - Hasil Rating
       <img width="1919" height="919" alt="image" src="https://github.com/user-attachments/assets/84a6ece9-7ea4-4266-aae3-e70f1de70408" />

















       

















