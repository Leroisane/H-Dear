<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\User\UndanganController;

Route::get('/', function () {
    return redirect()->route('undangan.index');
});

// User Routes
Route::prefix('undangan')->name('undangan.')->group(function () {
    Route::get('/', [UndanganController::class, 'index'])->name('index');
    Route::get('/create/{template}', [UndanganController::class, 'create'])->name('create');
    Route::post('/store', [UndanganController::class, 'store'])->name('store');
    Route::get('/preview/{id}', [UndanganController::class, 'preview'])->name('preview');
    Route::get('/download/{id}', [UndanganController::class, 'download'])->name('download');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('templates', TemplateController::class);
});

Route::get('/dashboard', function () {
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.templates.index');
    }
    return redirect()->route('undangan.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';