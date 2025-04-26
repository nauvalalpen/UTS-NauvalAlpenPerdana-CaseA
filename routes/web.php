<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

Route::get('/', function () {

    return redirect()->route('donasi.index');
});


Route::prefix('donasi')->name('donasi.')->group(function () {
    Route::get('deleted', [DonasiController::class, 'deleted'])->name('deleted');
    Route::get('restore/{id}', [DonasiController::class, 'restore'])->name('restore');
    Route::delete('force-delete/{id}', [DonasiController::class, 'forceDelete'])->name('forceDelete');
});

Route::resource('donasi', DonasiController::class);
