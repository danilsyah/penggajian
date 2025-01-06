    Sistem Informasi Penggajian Karyawan adalah sebuah platform berbasis web yang
    berfungsi untuk management dan pengolahan penggajian pada sebuah instansi atau perusahaan.
    pembuatan sistem ini menggunakan studi kasus pada perusahaan PT. Batam Bintan Telekomunikasi,
    dikarnakan sistem ini dibuat untuk penelitian skripsi S1.

    ^Website ini dibangun menggunakan :
    bahasa pemrograman : PHP v7.3.5
    Framework Laravel version 5.8.29
    Database : PostgreSQL v4.6

    - Modul :
    1. Departemen
    2. Jabatan
    3. Status Kawin
    4. Karyawan
    5. Kalender Kerja
    6. Kehadiran
    7. Pola Kerja
    8. Kelompok Kerja
    9. pengolahan gaji
    10. Laporan Slip gaji
    11. DLL
    sistem penggajian ini harus terus dikembangkan

"Note : 

        - data awal di pengaturan profil perusahaan masih manual di input dari db
        - data status kawin masih di input manual dari db


-- cara deploy di localhost menggunakan laragon
1. pastikan menggunakan versi php 7
2. buat database mariadb / mysql 

        create database db_penggajian

3. clone repository lalu masuk ke directory root project
4. ubah / copy file .env.example menjadi .env
5. edit file .env lalu sesuaikan nama db, user dan password db
    

6. lakukan composer update di dalam directory root project 

        $ composer update

7. Jalankan migration dan seeder user administrator database pada terminal 

        $ php artisan migrate:refresh --seed

8. jalankan generate key pada terminal
    
        $ php artisan key:generate
        $ php artisan config:cache
        $ php artisan route:cache
        $ php artisan view:cache

9. akses aplikasi lewat domain local web server pada laragon.

        http://penggajian.test

10. atau bisa juga menjalankan lewat terminal 

        $ php artisan serve
        http://127.0.0.1:8000


### reference for deployment to vps

        https://gist.github.com/alfajrimutawadhi/5f1d5174ab1d28142c16b159c51b2936


