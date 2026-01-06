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

    // Master Data Routes
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::get('/sumber-pendanaan-eksternal', \App\Livewire\MasterData\SumberPendanaanEksternal\Index::class)
            ->name('sumber-pendanaan-eksternal');
        Route::get('/kol-configuration', \App\Livewire\MasterData\KolConfiguration\Index::class)
            ->name('kol-configuration');
        Route::get('/cells-project', \App\Livewire\MasterData\CellsProject\Index::class)
            ->name('cells-project');
    });
});
