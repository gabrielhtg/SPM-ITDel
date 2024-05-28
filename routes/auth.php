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
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\HeroDashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleTreeController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\ListAllowedUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeroDocumentController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\ActiveNews;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::middleware('guest')->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')
        ->middleware(ActiveNews::class);


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

    Route::get('/register', [RegisteredUserController::class, 'getHalamanLogin'])->name('register-page');

    Route::post('/self-register', [RegisteredUserController::class, 'registerSelfUser'])->name('self-register');
    Route::get('/getdocument', [DocumentController::class, 'getDocument'])->name('getdocument');
    Route::get('/getdocumentspm', [DocumentController::class, 'getDocumentspm'])->name('getdocumentspm');
    Route::get('/view-document-detail/{id}', [DocumentController::class, 'getDocumentDetail'])->name('document-detail');

    //    Route::get('/document/{id}', [HeroDocumentController::class, 'getView'])->name('document.view');

    // News route as guest
    Route::get('/news/layoutdetail/{id}', [NewsController::class, 'getDetailnews'])->name('news-layout-user');
    Route::get('/news/page', [NewsController::class, 'getNewsPage'])->name('newspage');
    Route::get('/news/page/cari', [NewsController::class, 'carinews'])->name('carinews');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [RoleTreeController::class, 'indexlogindashboard'])->name('indexlogindashboard');

    // News route as admin
    Route::get('/news', [NewsController::class, 'getNews'])->name('news');
    Route::post('/addnews', [NewsController::class, 'store'])->name('newsadd');
    Route::get('/news/detail/{id}', [NewsController::class, 'getDetail'])->name('news.detail');
    Route::post('updatenews', [NewsController::class, 'updatenews'])->name('updatenews');
    Route::get('deletenews/{id}', [NewsController::class, 'deletenews'])->name('deletenews');

    Route::middleware('checkDocumentActive')->group(function () {
        Route::get('/user-settings-active', [UserController::class, 'getUserSettings'])->name('user-settings-active');
        Route::get('/user-settings-inactive', [UserController::class, 'getUserSettingsInactive'])->name('user-settings-inactive');
        Route::get('/employee', [EmployeeController::class, 'getEmployeePage'])->name('employee');
        Route::post('/add-employee', [EmployeeController::class, 'addEmployee'])->name('add-employee');
        Route::delete('/remove-employee', [EmployeeController::class, 'removeEmployee'])->name('remove-employee');
        Route::post('/edit-employee', [EmployeeController::class, 'editEmployee'])->name('edit-employee');

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

        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

        Route::delete('remove-user', [UserController::class, 'removeUser'])->name('remove-user');

        Route::get('/register-invitation', [RegisteredUserController::class, 'sendRegisterInvitationLink'])->name('register-invitation');

        Route::delete('/delete-invitation', [RegisteredUserController::class, 'deleteInvitation'])->name('delete-invitation');

        Route::delete('/clear-invitation', [RegisteredUserController::class, 'clearInvitation'])->name('clear-invitation');

        Route::post('/accept-register-request', [RegisteredUserController::class, 'acceptRegisterRequest'])->name('accept-register-request');
        Route::delete('/delete-register-request', [RegisteredUserController::class, 'deleteRegisterRequest'])->name('delete-register-request');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        //            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        //    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');.update');
        Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');

        Route::get('/change-profile-pict', [ProfileController::class, 'changeProfilePict'])->name('change-profile-pict');

        Route::post('/upload-profile-pict', [ProfileController::class, 'uploadProfilePict'])->name('uploadProfilePict');

        Route::post('/upload-file', [DocumentController::class, 'uploadFile'])->name('uploadFile');
        Route::post('/update-document/{id}', [DocumentController::class, 'updateDocument'])->name('updateDocument');
        Route::get('/document-add', [DocumentController::class, 'getDocumentManagementAdd'])->name('documentAdd');
        Route::get('/document/{id}/edit', [DocumentController::class, 'getDocumentManagementEdit'])->name('document.edit');
        Route::get('/hero/{id}/edit', [HeroDocumentController::class, 'edit'])->name('hero.edit');
        Route::put('/heroes/{id}', [HeroDocumentController::class, 'update'])->name('hero.update');
        Route::post('/laporan/add', [LaporanController::class, 'addLaporan'])->name('laporan.store');

        /**
         * Route ini digunakan untuk mendapatkan halaman user detail
         */
        Route::post("/user-detail", [UserController::class, 'getUserDetail'])->name('getUserDetail');
        Route::post("/user-detail-inactive", [UserController::class, 'getUserDetailInactive'])->name('getUserDetailInactive');

        /**
         * --------------DEPRECATED-----------------
         *
         * Method ini digunakan untuk mengembalikan akun yang sudah dinonaktifkan.
         */
        Route::post("/restore-account", [UserController::class, 'restoreAccount'])->name('restoreAccount');


        Route::delete('/remove-document', [DocumentController::class, 'removeDocument'])->name('remove-document');
        Route::post('upload-document-type', [TypeDocumentController::class, 'addDocumentType'])->name('uploadTypeDocument');
        Route::post('upload-laporan-type', [TypeDocumentController::class, 'addLaporanType'])->name('uploadTypeLaporan');
        Route::post('/edit-type-laporan/{id}', [TypeDocumentController::class, 'editLaporanType'])->name('editTypeLaporan');
        Route::post('/edit-jenis-laporan/{id}', [TypeDocumentController::class, 'updateLaporanJenis'])->name('editJenisLaporan');
        Route::delete('/delete-type-laporan/{id}', [TypeDocumentController::class, 'deleteLaporanType'])->name('deleteTypeLaporan');
        Route::post('upload-laporan-jenis', [TypeDocumentController::class, 'addLaporanJenis'])->name('uploadJenisLaporan');

        Route::get('/list-allowed-user', [ListAllowedUserController::class, 'getListAllowedUser'])->name('list-allowed-user');
        Route::post('/upload-list-allowed-user', [ListAllowedUserController::class, 'uploadListAllowedUser'])->name('uploadListAllowedUser');
        Route::delete('/delete-list-allowed-user', [ListAllowedUserController::class, 'removeFromList'])->name('removeFromList');
        Route::post('/add-list-allowed-user', [ListAllowedUserController::class, 'addAllowedUser'])->name('addAllowedUser');

        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');

        Route::get('/role-management', [RoleController::class, 'getHalamanRoleManagement'])->name('role-management');
        Route::post('/add-role', [RoleController::class, 'addRole'])->name('addRole');
        Route::post('/edit-role', [RoleController::class, 'editRole'])->name('editRole');
        Route::delete('/remove-role', [RoleController::class, 'removeRole'])->name('removeRole');
        Route::post('/change-role-status', [RoleController::class, 'updateStatus'])->name('update-status');

        // notifikasi
        Route::post('/open-notification', [NotificationController::class, 'getNotifications'])->name('openNotification');
        Route::get('/notification', [NotificationController::class, 'getNotificationPage'])->name('notification');
        Route::get('/remove-notification', [NotificationController::class, 'destroyNotification'])->name('destroy-notification');

         // about it del
        Route::get('/dashboard-admin', [DashboardController::class, 'getdashboard'])->name('dashboard-admin');
        Route::get('/guesslayout', [DashboardController::class, 'index'])->name('guesslayout')->middleware(ActiveNews::class);
        Route::post('/dashboard-admin', [DashboardController::class, 'storeintroduction'])->name('dashboard-introduction-add');
        Route::get('/dashboard/detail/{id}', [DashboardController::class, 'getdashboardintroductiondetail'])->name('dashboard-introduction-detail');
        Route::post('/updatedashboard/{id}', [DashboardController::class, 'updatedashboard'])->name('dashboard-introduction-udpate');
        Route::get('/deletedashboard/detail/{id}', [DashboardController::class, 'deletedashboard'])->name('dashboard-introduction-delete');

        // herosection
        Route::get('/dashboard-herosection', [HerodashboardController::class, 'indexherosection'])->name('herosection');
        Route::post('/dashboard-herosection', [HeroDashboardController::class, 'storeherosection'])->name('dashboard-herosection-add');
        Route::get('/herosection/detail/{id}', [HeroDashboardController::class, 'getDetailherosection'])->name('herosection-detail');
        Route::post('/updateherosection/{id}', [HeroDashboardController::class, 'updateherosection'])->name('dashboard-herosection-update');
        Route::get('/deleteherosection/detail/{id}', [HeroDashboardController::class, 'deleteherosection'])->name('dashboard-herosection-delete');

        // akreditasi
        Route::get('/dashboard-akreditasi', [AkreditasiController::class, 'indexherosection'])->name('akreditasi');
        Route::post('/dashboard-akreditasi', [AkreditasiController::class, 'storeherosection'])->name('dashboard-akreditasi-add');
        Route::get('/akreditasi/detail/{id}', [AkreditasiController::class, 'getDetailherosection'])->name('akreditasi-detail');
        Route::post('/updateakreditasi/{id}', [AkreditasiController::class, 'updateherosection'])->name('dashboard-akreditasi-update');
        Route::get('/deleteakreditasi/detail/{id}', [AkreditasiController::class, 'deleteherosection'])->name('dashboard-akreditasi-delete');
        Route::get('/mark-as-read-notification', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');

        Route::get('/log-activity', [LogActivityController::class, 'getLogActivityPage'])->name('getLogActivityPage');
        Route::get('/laporan-management-add', [LaporanController::class, 'getLaporanManagementView'])->name('LaporanManagementAdd');
        Route::get('/laporan-management-reject', [LaporanController::class, 'getLaporanManagementReject'])->name('LaporanManagementReject');
        Route::get('view-laporan-type', [DocumentController::class, 'getviewLaporanType'])->name('viewLaporanType');
        Route::get('view-laporan-jenis', [DocumentController::class, 'viewLaporanJenis'])->name('viewLaporanJenis');
        Route::get('/log-laporan', [LaporanController::class, 'getLogLaporanView'])->name('LogLaporanview');
        Route::get('/log-laporan-continue/{id}', [LaporanController::class, 'getLogLaporanContinue'])->name('LogLaporanContinue');
        Route::get('/jenis-laporan/{id}', [LaporanController::class, 'getJenisLaporanView'])->name('getJenisLaporanView');
        Route::put('/laporan/{id}/approve', [LaporanController::class, 'approve'])->name('laporan.approve');
        Route::put('/laporan/{id}/reject', [LaporanController::class, 'reject'])->name('laporan.reject');
        Route::put('/laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');
        Route::get('/dashboard-laporan', [DashboardLaporanController::class, 'index'])->name('dashboard-laporan');
        Route::get('/dashboard-laporan-continue', [DashboardLaporanController::class, 'getDashboardLaporanContinue'])->name('getDashboardlaporanContinue');
    });
});
