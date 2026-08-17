<?php

use App\Livewire\AllBerita;
use App\Livewire\DaftarPengajar;
use App\Livewire\DetailBerita;
use App\Livewire\DetailFasilitas;
use App\Livewire\DetailTeacher;
use App\Livewire\FasilitasSekolah;
use App\Livewire\HomePage;
use App\Livewire\KontakPage;
use App\Livewire\TentangPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/tentang', TentangPage::class)->name('tentang');
Route::get('/kontak', KontakPage::class)->name('kontak');
Route::get('/profile/pimpinan', DaftarPengajar::class)->name('profile.pimpinan');
Route::get('/profile/pengajar', DaftarPengajar::class)->name('profile.pengajar');
Route::get('/fasilitas', FasilitasSekolah::class)->name('fasilitas');
Route::get('/fasilitas/{facility:slug}', DetailFasilitas::class)->name('fasilitas.detail');

Route::get('/profile/pimpinan/{teacher:slug}', DetailTeacher::class)->name('profile.pimpinan.detail');
Route::get('/profile/pengajar/{teacher:slug}', DetailTeacher::class)->name('profile.pengajar.detail');

Route::get('/berita', AllBerita::class)->name('berita');
Route::get('/berita/{article:slug}', DetailBerita::class)->name('berita.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
