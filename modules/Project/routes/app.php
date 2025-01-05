<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\ProjectController;

Route::get('project', [
    ProjectController::class, 'index',
])->name('project.index');

Route::get('project/create', [
    ProjectController::class, 'create',
])->name('project.create');

Route::post('project', [
    ProjectController::class, 'store',
])->name('project.store');

Route::get('project/{id}', [
    ProjectController::class, 'view',
])->name('project.view');

Route::get('project/{id}/edit', [
    ProjectController::class, 'edit',
])->name('project.edit');

Route::put('project/{id}', [
    ProjectController::class, 'update',
])->name('project.update');

Route::delete('project/{id}', [
    ProjectController::class, 'destroy',
])->name('project.destroy');
