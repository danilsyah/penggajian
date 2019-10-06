<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@dashboard');

// routing page pengaturan
Route::get('pengaturan', 'SettingController@index');
Route::post('pengaturan', 'SettingController@save');
// ---end routing pengaturan--
// routing modul karyawan
Route::resource('departemen', 'DepartemenController');
Route::resource('jabatan', 'JabatanController');
Route::resource('karyawan', 'KaryawanController');
Route::get('/karyawan/{nik}/delete', 'KaryawanController@destroy');
Route::get('/karyawan/{nik}/polakerja', 'KaryawanController@polaKerja');
Route::get('/karyawan/{nik}/kehadiran', 'KaryawanController@kehadiran');
Route::get('/karyawan/{nik}/lembur', 'KaryawanController@lembur');
Route::post('/filter-lembur/{nik}', 'KaryawanController@filterLembur');
Route::post('/filter-kehadiran/{nik}', 'KaryawanController@filterKehadiran');
Route::resource('statuskawin', 'StatusKawinController');
// end modul karyawan

Route::resource('kalenderkerja', 'KalenderKerjaController');
Route::resource('polakerja', 'PolaKerjaController');

//routing fitur kelompok kerja
Route::resource('kelompokkerja', 'KelompokKerjaController');
Route::post('tambah-kelompok-kerja', 'KelompokKerjaController@tambahAnggota');
Route::delete('hapus-anggota-kelompok-kerja/{id}', 'KelompokKerjaController@hapusAnggota');
Route::get('kelompokkerja/{id}/polakerja', 'KelompokKerjaController@showPolaKerja');
Route::post('simpan-pola-kerja-kelompok-karyawan', 'KelompokKerjaController@simpanPolaKerja');
Route::delete('hapus-pola-kerja-kelompok-karyawan/{id}', 'KelompokKerjaController@hapusPolaKerjaKelompok');
// end fitur kelompok kerja

// routing modul kehadiran
Route::get('kehadiran', 'KehadiranController@index');
Route::get('kehadiran/create', 'KehadiranController@create');
Route::post('kehadiran', 'KehadiranController@store');
Route::delete('kehadiran/{id}', 'KehadiranController@destroy');
Route::post('ubah-periode-kehadiran', 'KehadiranController@ubahPeriodeKehadiran');
Route::post('export-laporan-kehadiran-excel', 'KehadiranController@exportExcel');
Route::post('import-excel-kehadiran', 'KehadiranController@importExcel');

// routing fitur lembur
Route::get('lembur', 'LemburController@index');
Route::get('lembur/create', 'LemburController@create');
Route::post('lembur', 'LemburController@store');
Route::post('ubah-periode-lembur', 'LemburController@ubahPeriodeLembur');
Route::delete('hapus-riwayat-lembur/{id}/{url}', 'LemburController@destroy');

// Modul penggajian
Route::get('komponenGaji', 'KomponenGajiController@index');
Route::get('komponenGaji/create', 'KomponenGajiController@create');
Route::post('komponenGaji', 'KomponenGajiController@store');
Route::get('komponenGaji/{kode_komponen}/edit', 'KomponenGajiController@edit');
Route::put('komponenGaji/{kode_komponen}', 'KomponenGajiController@update');
Route::delete('komponenGaji/{kode_komponen}', 'KomponenGajiController@destroy');
Route::resource('gaji', 'GajiController');
Route::post('ubah-periode-gaji', 'GajiController@ubahPeriodeGaji');
Route::post('tambah-komponen-gaji-detail', 'GajiController@tambahKomponenGajiDetail');
Route::delete('hapus-komponen-gaji-detail/{id}', 'GajiController@hapusKomponenGajiDetail');
// Route::get('gaji/{id}/pdf', 'GajiController@slipGajiPdf'); // menggunakan library DOMPDF
Route::get('gaji/{id}/pdf', 'GajiController@slipGajiPdf2'); // menggunakan library FPDF
Route::post('export-laporan-gaji-pdf', 'GajiController@laporanGaji');
