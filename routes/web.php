<?php

use App\Http\Controllers\BPAActivityCalendarController;
use App\Http\Controllers\BPAActivityLogsController;
use App\Http\Controllers\BPABranchAuditController;
use App\Http\Controllers\BPAFormsController;
use App\Http\Controllers\BPAImprovementController;
use App\Http\Controllers\BPAInternalAuditController;
use App\Http\Controllers\BPALoginLogs;
use App\Http\Controllers\BPAUsersController;
use App\Http\Controllers\BPAWarehouseController;
use App\Http\Controllers\ProfileController;
use App\Models\BPAActivityLogs;
use App\Models\BPAForms;
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

// Route::get('/', function () {
//     return view('welcome');
// });

    Route::redirect(uri:'/', destination:'login');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'firstlogin'])->name('dashboard');
// SYSTEM CONFIGURATIONS
    Route::middleware(['auth'])->group(function () {
        // Routes for Dashboard
            // ACTIVITY CALENDAR
            Route::get('/dashboard', [BPAActivityCalendarController::class, 'index'])->name('dashboard');
            Route::post('/saveEventData', [BPAActivityCalendarController::class, 'saveEventData'])->name('dashboard.saveEventData');

        // Routes for BPAUsersController
            // USER
            Route::get('/change-password/{key}', [BPAUsersController::class, 'changePassword'])->name('change.password');
            Route::post('/change-password/updatePassword}', [BPAUsersController::class, 'updatePassword'])->name('change-password.updatePassword');

            Route::get('/bpa-systemconfig/sc-users', [BPAUsersController::class, 'index'])->name('bpa-systemconfig.sc-users.index');
            Route::get('/bpa-systemconfig/sc-users/getUserData', [BPAUsersController::class, 'getUserData'])->name('bpa-systemconfig.sc-users.getUserData');
            Route::post('/bpa-systemconfig/sc-users/saveUserData', [BPAUsersController::class, 'saveUserData'])->name('bpa-systemconfig.sc-users.saveUserData');
            Route::get('/bpa-systemconfig/sc-users/getNameUser', [BPAUsersController::class, 'getNameUser'])->name('bpa-systemconfig.sc-users.getNameUser');
            Route::post('/bpa-systemconfig/sc-users/resetPasswordUser', [BPAUsersController::class, 'resetPasswordUser'])->name('bpa-systemconfig.sc-users.resetPasswordUser');
            Route::post('/bpa-systemconfig/sc-users/deleteUser', [BPAUsersController::class, 'deleteUser'])->name('bpa-systemconfig.sc-users.deleteUser');

            // LOGIN LOGS
            Route::get('/bpa-systemconfig/sc-loginlogs', [BPAUsersController::class, 'index'])->name('bpa-systemconfig.sc-loginlogs.index');

        // Routes for BPAFormsController
            // FORMS
            Route::get('/bpa-systemconfig/sc-forms', [BPAFormsController::class, 'index'])->name('bpa-systemconfig.sc-forms.index');
            Route::post('/bpa-systemconfig/sc-forms/saveFormData', [BPAFormsController::class, 'saveFormData'])->name('bpa-systemconfig.sc-forms.saveFormData');
            Route::get('/bpa-systemconfig/sc-forms/getFormData', [BPAFormsController::class, 'getFormData'])->name('bpa-systemconfig.sc-forms.getFormData');
            Route::post('/bpa-systemconfig/sc-forms/statusForm', [BPAFormsController::class, 'statusForm'])->name('bpa-systemconfig.sc-forms.statusForm');

            Route::post('/bpa-systemconfig/sc-forms/saveProcessData', [BPAFormsController::class, 'saveProcessData'])->name('bpa-systemconfig.sc-forms.saveProcessData');
            Route::get('/bpa-systemconfig/sc-forms/getProcessData', [BPAFormsController::class, 'getProcessData'])->name('bpa-systemconfig.sc-forms.getProcessData');
            Route::post('/bpa-systemconfig/sc-forms/statusProcess', [BPAFormsController::class, 'statusProcess'])->name('bpa-systemconfig.sc-forms.statusProcess');

            Route::post('/bpa-systemconfig/sc-forms/saveCPointData', [BPAFormsController::class, 'saveCPointData'])->name('bpa-systemconfig.sc-forms.saveCPointData');
            Route::get('/bpa-systemconfig/sc-forms/getCPointData', [BPAFormsController::class, 'getCPointData'])->name('bpa-systemconfig.sc-forms.getCPointData');
            Route::post('/bpa-systemconfig/sc-forms/statusCPoint', [BPAFormsController::class, 'statusCPoint'])->name('bpa-systemconfig.sc-forms.statusCPoint');

            Route::post('/bpa-systemconfig/sc-forms/saveQuestionData', [BPAFormsController::class, 'saveQuestionData'])->name('bpa-systemconfig.sc-forms.saveQuestionData');
            Route::get('/bpa-systemconfig/sc-forms/getQuestionData', [BPAFormsController::class, 'getQuestionData'])->name('bpa-systemconfig.sc-forms.getQuestionData');
            Route::post('/bpa-systemconfig/sc-forms/statusQuestion', [BPAFormsController::class, 'statusQuestion'])->name('bpa-systemconfig.sc-forms.statusQuestion');

            Route::post('/bpa-systemconfig/sc-forms/saveQuestionnaireData', [BPAFormsController::class, 'saveQuestionnaireData'])->name('bpa-systemconfig.sc-forms.saveQuestionnaireData');
            Route::get('/bpa-systemconfig/sc-forms/getQuestionnaireData', [BPAFormsController::class, 'getQuestionnaireData'])->name('bpa-systemconfig.sc-forms.getQuestionnaireData');
            Route::post('/bpa-systemconfig/sc-forms/statusQuestionnaire', [BPAFormsController::class, 'statusQuestionnaire'])->name('bpa-systemconfig.sc-forms.statusQuestionnaire');
            Route::post('/bpa-systemconfig/sc-forms/selectQuestionnaire', [BPAFormsController::class, 'selectQuestionnaire'])->name('bpa-systemconfig.sc-forms.selectQuestionnaire');

        // Routes for BPAActivityLogsController
            // ACTIVITY LOGS
            Route::get('/bpa-systemconfig/sc-activitylogs', [BPAActivityLogsController::class, 'index'])->name('bpa-systemconfig.sc-activitylogs.index');
    });

    // Routes for BPALoginLogs
        Route::middleware(['auth'])->group(function () {
            Route::get('/bpa-systemconfig/sc-loginlogs', [BPALoginLogs::class, 'index'])->name('bpa-systemconfig.sc-loginlogs.index');
        });

// Routes for BPAImprovementController
    Route::middleware(['auth'])->group(function () {
        Route::get('/bpa-improvement', [BPAImprovementController::class, 'index'])->name('bpa-improvement.index');
    });

// Routes for BPAInternalAuditController
    Route::middleware(['auth'])->group(function () {
        Route::get('/bpa-internalaudit', [BPAInternalAuditController::class, 'index'])->name('bpa-internalaudit.index');
    });

// Routes for BPABranchAuditController
    Route::middleware(['auth'])->group(function () {
        Route::get('/bpa-branchaudit', [BPABranchAuditController::class, 'index'])->name('bpa-branchaudit.index');
    });

// Routes for BPAWarehouseController
    Route::middleware(['auth'])->group(function () {
        Route::get('/bpa-warehouse', [BPAWarehouseController::class, 'index'])->name('bpa-warehouse.index');
    });

    Route::middleware(['auth','firstlogin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';
