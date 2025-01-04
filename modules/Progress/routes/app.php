<?php

use Illuminate\Support\Facades\Route;
use Modules\Progress\Http\Controllers\ProgressController;

Route::get('progress', [
    ProgressController::class, 'index', 
])->name('progress.index');

Route::get('progress/create', [
    ProgressController::class, 'create',
])->name('progress.create');

Route::post('progress', [
    ProgressController::class, 'store',
])->name('progress.store');

Route::get('progress/{id}/edit', [
    ProgressController::class, 'edit',
])->name('progress.edit');

Route::put('progress/{id}', [
    ProgressController::class, 'update',
])->name('progress.update');

Route::delete('progress/{id}', [
    ProgressController::class, 'destroy',
])->name('progress.destroy');
