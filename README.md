<p align="center">
  <a href="https://primakara.ac.id" target="_blank">
    <img src="public/assets/image/banner/ormawaprimakara.jpg" 
         width="800" alt="Primakara Ormawa Logo">
  </a>
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" 
         width="95" alt="Laravel Logo" style="margin-right: 20px;">
  </a>
  <a href="https://tailwindcss.com" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" 
         width="75" alt="TailwindCSS Logo" style="margin-right: 20px;">
  </a>
  <a href="https://www.php.net" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" 
         width="75" alt="PHP Logo" style="margin-right: 20px;">
  </a>
  <a href="https://www.mysql.com" target="_blank">
    <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" 
         width="80" alt="MySQL Logo">
  </a>

</p>


## Tentang Sistem Informasi Organisasi Mahasiswa

Sistem Informasi Organisasi mahasiswa merupakan sistem informasi berbasis website untuk mengelola kegiatan, program kerja, anggota, kepanitiaan, dan informasi Organisasi Mahasiswa (ORMAWA) di Primakara University. Dibangun menggunakan Laravel 11 dan TailwindCSS, dengan desain modern, cepat, dan mudah dikembangkan. Berikut merupakan fitur apa saja yang terdapat pada sistem ini : 

- Manajemen Unit Kegiatan Mahasiswa / HIMA / BEM
- Manajemen Program Kerja (Proker)
- Manajemen Event & Pendaftaran Kepanitiaan
- Manajemen Anggota
- Dashboard Admin
- CRUD Lengkap
- Responsive UI dengan TailwindCSS

## Tech Stack
- Backend: Laravel 11
- Frontend: TailwindCSS
- Database: MySQL

## Instalasi & Setup
Ikuti langkah di bawah untuk menjalankan proyek ini secara lokal.

1.  Clone Repository :</p>
   git clone https://github.com/username/nama-project.git</p>
   cd nama-project
2. Install Dependency Backend :</p>
    composer install
3. Install Dependency Frontend :</p>
    npm install
4. Setup Environment :</p>
 - Copy file .env.example menjadi .env :</p>
   cp .env.example .env
 - Generate application key :</p>
   php artisan key:generate
5. Konfigurasi Database :</p>
   Edit file .env :</p>
   DB_CONNECTION=mysql</p>
   DB_HOST=127.0.0.1</p>
   DB_PORT=3306</p>
   DB_DATABASE=nama_database</p>
   DB_USERNAME=root</p>
   DB_PASSWORD=</p>
6. Migrasi Database :</p>
   php artisan migrate
7. Build Asset Frontend :</p>
   npm run dev

## Pengembang
Proyek ini dibuat sebagai bagian dari skripsi dengan judul:

"Sistem Informasi Organisasi Mahasiswa Berbasis Website dengan Metode Extreme Programming di Primakara University"
