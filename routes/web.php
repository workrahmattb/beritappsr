<?php

use App\Livewire\Admin\AdminBerita;
use App\Livewire\AllBerita;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/berita', AllBerita::class)->name('berita');
Route::get('/berita/{article:slug}', App\Livewire\DetailBerita::class)->name('berita.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('admin/berita', 'admin.berita')->name('admin.berita');
});

require __DIR__.'/settings.php';

