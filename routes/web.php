<?php

use App\Http\Controllers\BPABranchAuditController;
use App\Http\Controllers\BPAImprovementController;
use App\Http\Controllers\BPAInternalAuditController;
use App\Http\Controllers\BPALoginLogs;
use App\Http\Controllers\BPAUsersController;
use App\Http\Controllers\BPAWarehouseController;
use App\Http\Controllers\ProfileController;
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
    // Routes for BPAUsersController
        Route::middleware(['auth'])->group(function () {
            Route::get('/change-password/{key}', [BPAUsersController::class, 'changePassword'])->name('change.password');
            Route::post('/change-password/updatePassword}', [BPAUsersController::class, 'updatePassword'])->name('change-password.updatePassword');

            Route::get('/bpa-systemconfig/sc-users', [BPAUsersController::class, 'index'])->name('bpa-systemconfig.sc-users.index');
            Route::get('/bpa-systemconfig/sc-activitylogs', [BPAUsersController::class, 'index'])->name('bpa-systemconfig.sc-activitylogs.index');
            Route::get('/bpa-systemconfig/sc-loginlogs', [BPAUsersController::class, 'index'])->name('bpa-systemconfig.sc-loginlogs.index');
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
