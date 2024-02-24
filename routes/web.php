<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/document-management', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementView'])->name('documentManagement');

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-settings-active', [UserController::class, 'getUserSettings'])->name('user-settings-active');
    Route::get('/user-settings-inactive', [UserController::class, 'getUserSettings'])->name('user-settings-inactive');
    Route::get('/announcement', [AnnouncementController::class, 'getAnnouncement'])->name('announcement');
    Route::post('/announcement', [AnnouncementController::class, 'store'])->name('announcement.add');
    Route::get('/announcement/detail/{id}', [AnnouncementController::class, 'getDetail'])->name('announcement.detail');
    Route::post('/updateannouncement/{id}', [AnnouncementController::class, 'updateannouncement'])->name('updateannouncement');
    Route::get('/deleteannouncement/detail/{id}', [AnnouncementController::class, 'deleteannouncement'])->name('deleteannouncement');
});

require __DIR__ . '/auth.php';
