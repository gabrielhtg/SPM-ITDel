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
Route::get('/document-management-all', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementViewSpmAll'])->name('documentManagementSpmAll');
Route::get('/document-replaced-all/{id}', [\App\Http\Controllers\DocumentController::class, 'getDocumentDetailReplaced'])->name('documentReplaced');
Route::get('/laporan-management-add', [\App\Http\Controllers\LaporanController::class, 'getLaporanManagementView'])->name('LaporanManagementAdd');
Route::get('/laporan-management-reject', [\App\Http\Controllers\LaporanController::class, 'getLaporanManagementReject'])->name('LaporanManagementReject');
Route::get('view-laporan-type', [\App\Http\Controllers\DocumentController::class, 'getviewLaporanType'])->name('viewLaporanType');
Route::get('view-laporan-jenis', [\App\Http\Controllers\DocumentController::class, 'viewLaporanJenis'])->name('viewLaporanJenis');
Route::get('/log-laporan', [\App\Http\Controllers\LaporanController::class, 'getLogLaporanView'])->name('LogLaporanview');
Route::get('/log-laporan-continue/{id}', [\App\Http\Controllers\LaporanController::class, 'getLogLaporanContinue'])->name('LogLaporanContinue');
Route::get('/jenis-laporan/{id}', [\App\Http\Controllers\LaporanController::class, 'getJenisLaporanView'])->name('getJenisLaporanView');
Route::put('/laporan/{id}/approve', [\App\Http\Controllers\LaporanController::class, 'approve'])->name('laporan.approve');
Route::put('/laporan/{id}/reject', [\App\Http\Controllers\LaporanController::class, 'reject'])->name('laporan.reject');
Route::put('/laporan/update/{id}', [\App\Http\Controllers\LaporanController::class, 'update'])->name('laporan.update');
Route::get('/dashboard-laporan', [\App\Http\Controllers\DashboardLaporanController::class, 'index'])->name('dashboard-laporan');
Route::get('/dashboard-laporan-continue', [\App\Http\Controllers\DashboardLaporanController::class, 'getDashboardLaporanContinue'])->name('getDashboardlaporanContinue');







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
    Route::get('/news', [NewsController::class, 'getNews'])->name('news');
    Route::post('/addnews', [NewsController::class, 'store'])->name('newsadd');
    Route::get('/news/detail/{id}', [NewsController::class, 'getDetail'])->name('news.detail');
    Route::post('updatenews/{id}', [NewsController::class, 'updatenews'])->name('updatenews');
    Route::get('deletenews/{id}', [NewsController::class, 'deletenews'])->name('deletenews');



});

require __DIR__ . '/auth.php';
