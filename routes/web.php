<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');


Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');
Route::post('loginPostAdmin', [UserController::class, 'loginPostAdmin'])->name('loginPostAdmin');

Route::middleware('auth:web')->group(function () {
    // Dashboard admin
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');
    // Dashboard umum
    
    // Route::get('divisi-list', [DivisiController::class, 'index'])->name('divisi-list');
    // Route::get('divisi-create', [DivisiController::class, 'create'])->name('divisi-create');
    // Route::post('divisi-store', [DivisiController::class, 'store'])->name('divisi-store');
    // Route::get('divisi-edit/{id}', [DivisiController::class, 'edit'])->name('divisi-edit');
    // Route::post('divisi-update/{id}', [DivisiController::class, 'update'])->name('divisi-update');
    // Route::get('divisi-destroy/{id}', [DivisiController::class, 'destroy'])->name('divisi-destroy');
    
    


    // Master Data
     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    // Departement
    Route::resource('departements', DepartementController::class);

    // Users
    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

    
    // History Log
    Route::resource('history-log', HistoryLogController::class)->except([
        'show', 'create', 'store', 'edit', 'update'
    ]);;

    // profilr edit
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);;
    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');


});

