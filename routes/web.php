<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HerodashboardController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Middleware\ActiveNews;
use App\Models\Akreditasi;
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
Route::get('/document-management-all', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementViewAll'])->name('documentManagementAll');
Route::get('/document-management-spm', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementViewSpmAll'])->name('documentManagementSpmAll');
Route::get('/document-replaced-all/{id}', [\App\Http\Controllers\DocumentController::class, 'getDocumentDetailReplaced'])->name('documentReplaced');







Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/news/layoutdetail/{id}', [NewsController::class, 'getDetailnews'])->name('news-layout-user');
Route::get('/news/page', [NewsController::class, 'getNewsPage'])->name('newspage');
Route::get('/news/page/cari', [NewsController::class, 'carinews'])->name('carinews');
Route::middleware('auth')->group(function () {

    //    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-settings-active', [UserController::class, 'getUserSettings'])->name('user-settings-active');
    Route::get('/user-settings-inactive', [UserController::class, 'getUserSettingsInactive'])->name('user-settings-inactive');
    



});

require __DIR__ . '/auth.php';
