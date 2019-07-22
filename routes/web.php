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

Route::get('/', function () {
    return view('template');
});

// routing page pengaturan
Route::get('pengaturan', 'SettingController@index');
Route::post('pengaturan', 'SettingController@save');
// ---end routing pengaturan--

Route::resource('departemen', 'DepartemenController');
Route::resource('jabatan', 'JabatanController');
Route::resource('karyawan', 'KaryawanController');
Route::resource('statuskawin', 'StatusKawinController');
Route::resource('kalenderkerja', 'KalenderKerjaController');
Route::resource('polakerja', 'PolaKerjaController');
// routing modul kehadiran
Route::get('kehadiran', 'KehadiranController@index');
Route::get('kehadiran/create', 'KehadiranController@create');
Route::post('kehadiran', 'KehadiranController@store');
Route::post('ubah-periode-kehadiran', 'KehadiranController@ubahPeriodeKehadiran');
