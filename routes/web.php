<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\ParkirKeluarController;
use App\Http\Controllers\ParkirMasukController;
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
// disini buat pengaturan code route nya 

// route untuk view login 
Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

// route untuk view register 
Route::get('register', [RegisterController::class, 'index'])->name('register');
// route untuk request login 
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');


// disini route jika user berhasil login 
Route::middleware('auth:web')->group(function () {
    // Dashboard admin
    
    // disini route untuk dashboard 
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    // disini route untuk list approval user 
    Route::get('approval-list', [ApprovalRegisterController::class, 'index'])->name('approval-list');

    // disini route funsgi action untuk approval user 
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');

    
    // disini route untuk mengatur jenis kendaraan 
    Route::get('jenis-kendaraan-list', [JenisKendaraanController::class, 'index'])->name('jenis-kendaraan-list');
    Route::post('jenis-kendaraan-store', [JenisKendaraanController::class, 'store'])->name('jenis-kendaraan-store');
    Route::post('jenis-kendaraan-update/{id}', [JenisKendaraanController::class, 'update'])->name('jenis-kendaraan-update');
    Route::get('jenis-kendaraan-destroy/{id}', [JenisKendaraanController::class, 'destroy'])->name('jenis-kendaraan-destroy');
    
    // disini route untuk mengatur parkir masuk 
    Route::get('parkir-masuk-list', [ParkirMasukController::class, 'index'])->name('parkir-masuk-list');
    Route::post('parkir-masuk-store', [ParkirMasukController::class, 'store'])->name('parkir-masuk-store');
    Route::post('parkir-masuk-update/{id}', [ParkirMasukController::class, 'update'])->name('parkir-masuk-update');
    Route::get('parkir-masuk-destroy/{id}', [ParkirMasukController::class, 'destroy'])->name('parkir-masuk-destroy');
    
    // disini route untuk mengatur parkir keluar 
    Route::get('parkir-keluar-list', [ParkirKeluarController::class, 'index'])->name('parkir-keluar-list');
    Route::get('detail-parkir/{id}', [ParkirKeluarController::class, 'detail'])->name('detail-parkir');
    Route::post('parkir-keluar-store', [ParkirKeluarController::class, 'store'])->name('parkir-keluar-store');
    Route::get('parkir-keluar-destroy/{id}', [ParkirKeluarController::class, 'destroy'])->name('parkir-keluar-destroy');
    Route::post('parkir-keluar-bayar/{id}', [ParkirKeluarController::class, 'bayar'])->name('parkir-keluar-bayar');
    
    // disini route untuk mengatur laporan excel 
    Route::get('export', [DashboardController::class, 'export'])->name('export');
    
    // Master Data
    // disini route untuk mengatur view master data 
     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    // Departement
    // disini route untuk mengatur departements role 
    Route::resource('departements', DepartementController::class);

    // Users
    // disini route untuk fungsi change password 
    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    // disini route untuk mengatur management user 
    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    // disni route untuk fungsi hapus user 
    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

   
    // profilr edit
    // disini fungsi untuk mengatur halaman edit profile yg kanan atas di dashboard 
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);

        // disini route untuk fungsi change password dari halaman profile
    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::get('history-log', function () {
        return view('history.index');
    })->name('history.log');


});

