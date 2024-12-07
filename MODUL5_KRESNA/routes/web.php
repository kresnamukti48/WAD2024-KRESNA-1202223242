<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', 'HomeController@index')->name('home');

// Dosen
Route::get('dosen', 'DosenController@index')->name('dosen.index');
Route::get('dosen/create', 'DosenController@create')->name('dosen.create');
Route::post('dosen', 'DosenController@store')->name('dosen.store');
Route::get('dosen/{id}', 'DosenController@show')->name('dosen.show');
Route::get('dosen/{id}/edit', 'DosenController@edit')->name('dosen.edit');
Route::put('dosen/{id}', 'DosenController@update')->name('dosen.update');
Route::delete('dosen/{id}', 'DosenController@destroy')->name('dosen.destroy');

// Mahasiswa
Route::get('mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
Route::get('mahasiswa/create', 'MahasiswaController@create')->name('mahasiswa.create');
Route::post('mahasiswa', 'MahasiswaController@store')->name('mahasiswa.store');
Route::get('mahasiswa/{id}', 'MahasiswaController@show')->name('mahasiswa.show');
Route::get('mahasiswa/{id}/edit', 'MahasiswaController@edit')->name('mahasiswa.edit');
Route::put('mahasiswa/{id}', 'MahasiswaController@update')->name('mahasiswa.update');
Route::delete('mahasiswa/{id}', 'MahasiswaController@destroy')->name('mahasiswa.destroy');
