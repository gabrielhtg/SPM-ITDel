<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HerodashboardController;
use App\Models\Dashboard;
use App\Models\HeroDashboard;
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
Route::get('/document-management-all', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementViewAll'])->name('documentManagementAll');
Route::get('/document-replaced-all/{id}', [\App\Http\Controllers\DocumentController::class, 'getDocumentDetailReplaced'])->name('documentReplaced');
Route::get('/document-management-add', [\App\Http\Controllers\DocumentController::class, 'getDocumentManagementAdddoc'])->name('documentManagementAdd');



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


    // about it del
    Route::get('/dashboard-admin', [DashboardController::class, 'getdashboard'])->name('dashboard-admin');
    Route::get('/guesslayout', [DashboardController::class, 'index'])->name('guesslayout');
    Route::post('/dashboard-admin', [DashboardController::class, 'storeintroduction'])->name('dashboard-introduction-add');
    // Route::get('/dashboard-admin', [DashboardController::class, 'storeintroduction'])->name('dashboard-introduction-add');
    Route::get('/dashboard/detail/{id}', [DashboardController::class, 'getdashboardintroductiondetail'])->name('dashboard-introduction-detail');
    Route::post('/updatedashboard/{id}', [DashboardController::class, 'updatedashboard'])->name('dashboard-introduction-udpate');
    Route::get('/deletedashboard/detail/{id}', [DashboardController::class, 'deletedashboard'])->name('dashboard-introduction-delete');

    // herosection
    Route::get('/dashboard-herosection', [HerodashboardController::class, 'indexherosection'])->name('herosection');
    Route::post('/dashboard-herosection', [HeroDashboardController::class, 'storeherosection'])->name('dashboard-herosection-add');
    Route::get('/herosection/detail/{id}', [HeroDashboardController::class, 'getDetailherosection'])->name('herosection-detail');
    Route::post('/updateherosection/{id}', [HeroDashboardController::class, 'updateherosection'])->name('dashboard-herosection-update');
    Route::get('/deleteherosection/detail/{id}', [HeroDashboardController::class, 'deleteherosection'])->name('dashboard-herosection-delete');


});

require __DIR__ . '/auth.php';
