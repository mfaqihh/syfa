<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Peminjaman Dana Routes
    Route::get('/peminjaman-dana', \App\Livewire\PeminjamanDana\Index::class)
        ->name('peminjaman-dana');
    Route::get('/peminjaman-dana/create', \App\Livewire\PeminjamanDana\Create::class)
        ->name('peminjaman-dana.create');

    Route::get('/ar-perbulan', \App\Livewire\ArPerbulan\Index::class)
        ->name('ar-perbulan');

    // Master Data Routes
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::get('/sumber-pendanaan-eksternal', \App\Livewire\MasterData\SumberPendanaanEksternal\Index::class)
            ->name('sumber-pendanaan-eksternal');
        Route::get('/kol-configuration', \App\Livewire\MasterData\KolConfiguration\Index::class)
            ->name('kol-configuration');
        Route::get('/cells-project', \App\Livewire\MasterData\CellsProject\Index::class)
            ->name('cells-project');
        Route::get('/debitur-dan-investor', \App\Livewire\MasterData\DebiturDanInvestor\Index::class)
            ->name('debitur-dan-investor');
    });

    Route::prefix('access-control')->name('access-control.')->group(function () {

    });
});
