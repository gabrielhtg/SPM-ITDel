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
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
//    Route::get('register', [RegisteredUserController::class, 'create'])
//                ->name('register');

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


    Route::post('/register-invite', [RegisteredUserController::class, 'storeFromInvitationLink']);

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

    Route::delete('remove-user', [\App\Http\Controllers\UserController::class, 'removeUser'])->name('remove-user');

    Route::get('/register-invitation', [RegisteredUserController::class, 'sendRegisterInvitationLink'])->name('register-invitation');

    Route::delete('/delete-invitation', [RegisteredUserController::class, 'deleteInvitation'])->name('delete-invitation');

    Route::delete('/clear-invitation', [RegisteredUserController::class, 'clearInvitation'])->name('clear-invitation');

    Route::post('/accept-reset-request', [RegisteredUserController::class, 'acceptResetRequest'])->name('accept-reset-request');
    Route::delete('/delete-reset-request', [RegisteredUserController::class, 'deleteResetRequest'])->name('delete-reset-request');

    Route::get('/edit-profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit-profile');

    Route::get('/change-profile-pict', [\App\Http\Controllers\ProfileController::class, 'changeProfilePict'])->name('change-profile-pict');

    Route::post('/upload-profile-pict', [\App\Http\Controllers\ProfileController::class, 'uploadProfilePict'])->name('uploadProfilePict');

    Route::post('/upload-file', [\App\Http\Controllers\DocumentController::class, 'uploadFile'])->name('uploadFile');

    Route::post("/user-detail", [\App\Http\Controllers\UserController::class, 'getUserDetail'])->name('getUserDetail');

    Route::delete('/remove-document', [\App\Http\Controllers\DocumentController::class, 'removeDocument'])->name('remove-document');
});
