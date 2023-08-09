<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
<<<<<<< HEAD
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\ParkirKeluarController;
use App\Http\Controllers\ParkirMasukController;
=======
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterRtController;
use App\Http\Controllers\MasterRwController;
>>>>>>> 3b87fe0e48d65581d6a3c7f7cd8bbf8a8406e833
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
// disini buat pengaturan code route nya 

// route untuk view login 
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

    
<<<<<<< HEAD
    // disini route untuk mengatur jenis kendaraan 
    Route::get('jenis-kendaraan-list', [JenisKendaraanController::class, 'index'])->name('jenis-kendaraan-list');
    Route::post('jenis-kendaraan-store', [JenisKendaraanController::class, 'store'])->name('jenis-kendaraan-store');
    Route::post('jenis-kendaraan-update/{id}', [JenisKendaraanController::class, 'update'])->name('jenis-kendaraan-update');
    Route::get('jenis-kendaraan-destroy/{id}', [JenisKendaraanController::class, 'destroy'])->name('jenis-kendaraan-destroy');
=======
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
>>>>>>> 3b87fe0e48d65581d6a3c7f7cd8bbf8a8406e833
    
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

