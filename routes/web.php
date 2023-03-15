<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterRtController;
use App\Http\Controllers\MasterRwController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SliderController;
use App\Models\Berita;
use App\Models\Slider;
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
    $data['page_title'] = "Home";
    $data['berita'] = Berita::where('aktif','Ya')->orderby('id', 'desc')->get();
    $data['slider'] = Slider::where('aktif','Ya')->orderby('id', 'desc')->get();

    return view('landing.home', $data);
})->name('user.login');

Route::get('berita/{id}', [BeritaController::class, 'show'])->name('berita');


Route::get('/login', function () {
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
    
    Route::get('slider-list', [SliderController::class, 'index'])->name('slider-list');
    Route::get('slider-create', [SliderController::class, 'create'])->name('slider-create');
    Route::post('slider-store', [SliderController::class, 'store'])->name('slider-store');
    Route::get('slider-edit/{id}', [SliderController::class, 'edit'])->name('slider-edit');
    Route::post('slider-update/{id}', [SliderController::class, 'update'])->name('slider-update');
    Route::get('slider-destroy/{id}', [SliderController::class, 'destroy'])->name('slider-destroy');
    
    Route::get('berita-list', [BeritaController::class, 'index'])->name('berita-list');
    Route::get('berita-create', [BeritaController::class, 'create'])->name('berita-create');
    Route::post('berita-store', [BeritaController::class, 'store'])->name('berita-store');
    Route::get('berita-edit/{id}', [BeritaController::class, 'edit'])->name('berita-edit');
    Route::post('berita-update/{id}', [BeritaController::class, 'update'])->name('berita-update');
    Route::get('berita-destroy/{id}', [BeritaController::class, 'destroy'])->name('berita-destroy');
    
    Route::get('master-rw-list', [MasterRwController::class, 'index'])->name('master-rw-list');
    Route::get('master-rw-create', [MasterRwController::class, 'create'])->name('master-rw-create');
    Route::post('master-rw-store', [MasterRwController::class, 'store'])->name('master-rw-store');
    Route::get('master-rw-edit/{id}', [MasterRwController::class, 'edit'])->name('master-rw-edit');
    Route::post('master-rw-update/{id}', [MasterRwController::class, 'update'])->name('master-rw-update');
    Route::get('master-rw-destroy/{id}', [MasterRwController::class, 'destroy'])->name('master-rw-destroy');
    
    Route::get('master-rt-list', [MasterRtController::class, 'index'])->name('master-rt-list');
    Route::get('master-rt-create', [MasterRtController::class, 'create'])->name('master-rt-create');
    Route::post('master-rt-store', [MasterRtController::class, 'store'])->name('master-rt-store');
    Route::get('master-rt-edit/{id}', [MasterRtController::class, 'edit'])->name('master-rt-edit');
    Route::post('master-rt-update/{id}', [MasterRtController::class, 'update'])->name('master-rt-update');
    Route::get('master-rt-destroy/{id}', [MasterRtController::class, 'destroy'])->name('master-rt-destroy');
    
    
    Route::get('master-jabatan-list', [MasterJabatanController::class, 'index'])->name('master-jabatan-list');
    Route::get('master-jabatan-create', [MasterJabatanController::class, 'create'])->name('master-jabatan-create');
    Route::post('master-jabatan-store', [MasterJabatanController::class, 'store'])->name('master-jabatan-store');
    Route::get('master-jabatan-edit/{id}', [MasterJabatanController::class, 'edit'])->name('master-jabatan-edit');
    Route::post('master-jabatan-update/{id}', [MasterJabatanController::class, 'update'])->name('master-jabatan-update');
    Route::get('master-jabatan-destroy/{id}', [MasterJabatanController::class, 'destroy'])->name('master-jabatan-destroy');
    
    


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

