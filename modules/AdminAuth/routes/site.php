<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Modules\AdminAuth\Http\Controllers\AuthenticatedSessionController;
use Modules\AdminAuth\Http\Controllers\NewPasswordController;
use Modules\AdminAuth\Http\Controllers\PasswordResetLinkController;
use Modules\User\Models\User;

Route::get(config('modular.login-url'), [
    AuthenticatedSessionController::class, 'loginForm',
])->name('adminAuth.loginForm');

Route::post('/admin-auth/login', [
    AuthenticatedSessionController::class, 'login',
])->name('adminAuth.login');

Route::get('/admin-auth/logout', [
    AuthenticatedSessionController::class, 'logout',
])->name('adminAuth.logout');

// form to receive the email that contains the link to reset password
Route::get('/admin-auth/forgot-password', [
    PasswordResetLinkController::class, 'forgotPasswordForm',
])->name('adminAuth.forgotPassword');

Route::post('/admin-auth/send-reset-link-email', [
    PasswordResetLinkController::class, 'sendResetLinkEmail',
])->name('adminAuth.sendResetLinkEmail');

// password reset form
Route::get('/admin-auth/reset-password/{token}', [
    NewPasswordController::class, 'resetPasswordForm',
])->name('adminAuth.resetPasswordForm');

Route::post('/admin-auth/reset-password', [
    NewPasswordController::class, 'store',
])->name('adminAuth.resetPassword');

// Discord login
Route::get('/login/social', function(){
    if (Auth::check()) {
        return Inertia::render('Dashboard/DashboardIndex');
    }
    Socialite::driver('discord')->redirect();
});

Route::get('/login/social', function(){
    if (Auth::check()) {
        return Inertia::render('Dashboard/DashboardIndex');
    }
    return Socialite::driver('discord')->redirect();
});

Route::get('/auth/callback', function() {
    $discordUser = Socialite::driver('discord')->stateless()->user();

    $user = User::updateOrCreate([
        'email' => $discordUser->email,
    ], [
        'name' => $discordUser->name,
        'email' => $discordUser->email,
        'discord_id' => $discordUser->id,
        'discord_token' => $discordUser->token,
        'discord_refresh_token' => $discordUser->refreshToken,
        'avatar' => $discordUser->avatar,
    ]);
 
    Auth::login($user);
    return Inertia::render('Dashboard/DashboardIndex');
});