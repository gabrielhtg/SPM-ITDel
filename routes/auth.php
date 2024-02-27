<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ListAllowedUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('/self-register', [RegisteredUserController::class, 'registerSelfUser'])->name('self-register');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::delete('remove-user', [UserController::class, 'removeUser'])->name('remove-user');

    Route::get('/register-invitation', [RegisteredUserController::class, 'sendRegisterInvitationLink'])->name('register-invitation');

    Route::delete('/delete-invitation', [RegisteredUserController::class, 'deleteInvitation'])->name('delete-invitation');

    Route::delete('/clear-invitation', [RegisteredUserController::class, 'clearInvitation'])->name('clear-invitation');

    Route::post('/accept-register-request', [RegisteredUserController::class, 'acceptRegisterRequest'])->name('accept-register-request');
    Route::delete('/delete-register-request', [RegisteredUserController::class, 'deleteRegisterRequest'])->name('delete-register-request');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');

    Route::get('/change-profile-pict', [ProfileController::class, 'changeProfilePict'])->name('change-profile-pict');

    Route::post('/upload-profile-pict', [ProfileController::class, 'uploadProfilePict'])->name('uploadProfilePict');

    Route::post('/upload-file', [DocumentController::class, 'uploadFile'])->name('uploadFile');

    Route::post("/user-detail", [UserController::class, 'getUserDetail'])->name('getUserDetail');
    Route::post("/restore-account", [UserController::class, 'restoreAccount'])->name('restoreAccount');

    Route::delete('/remove-document', [DocumentController::class, 'removeDocument'])->name('remove-document');

    Route::get('/list-allowed-user', [ListAllowedUserController::class, 'getListAllowedUser'])->name('list-allowed-user');
    Route::post('/upload-list-allowed-user', [ListAllowedUserController::class, 'uploadListAllowedUser'])->name('uploadListAllowedUser');
    Route::delete('/delete-list-allowed-user', [ListAllowedUserController::class, 'removeFromList'])->name('removeFromList');
    Route::post('/add-list-allowed-user', [ListAllowedUserController::class, 'addAllowedUser'])->name('addAllowedUser');

    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
});
