<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Project\Http\Controllers\ProjectController;

Route::get('/dashboard', [
    // DashboardController::class, 'index',
    ProjectController::class, 'index'
])->name('dashboard.index');
