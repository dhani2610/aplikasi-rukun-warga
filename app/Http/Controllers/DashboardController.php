<?php

namespace App\Http\Controllers;

use App\Exports\Laporan;
use App\Models\JenisKendaraan;
use App\Models\ParkirKeluar;
use App\Models\ParkirMasuk;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only'=> 'dashboard']);
    }

    // disini fungsi untuk mengatur data yang ditampilkan di view dashboard 
    public function dashboard(Request $request)
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';

        // disini fungsi untuk count data atau fungsi untuk mentotalkan data disetiap jenis nya 
        // disisini semua fungsi sama saja 
        // $data['countMotor'] atau yg lain nya ini artinya kita bikin array countMotor yang di tampung di variable data 
        // disini ada query join...artinya table ini berelasi satu sama lain 
        // salah satu contohnya gini 
        // DB::table('parkir_keluars') ini artinya kita get data dari table parkir keluar kemudian kita join kaya di bawah ini
        // ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk') 
        // code itu artinya table parkir_masuks berelasi dengan table parkir_keluars dengan penghubung nya yaitu id parkir masuk 
        // kemudian untuk code select itu artinya kita setting untuk variable ini data apa saja yg ingin ditampilkan 
        // ->whereDate('parkir_keluars.created_at',date('Y-m-d')) ini artinya untuk filter tanggal parkir keluar berdasarkan hari ini 
        // >where('jenis_kendaraans.nama_kendaraan','Motor') ini artinya kita memfilter lagi jenis kendaraan nya...bisa di perhatikan ada Motor Mobil dan Truck..
        // ->get() ini artinya kita get semua data yang sudah kita select kemudian kita ->count(); artinya kita hitung datanya ada berapa

        $data['countMotor'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->whereDate('parkir_keluars.created_at',date('Y-m-d'))
        ->where('jenis_kendaraans.nama_kendaraan','Motor')
        ->get()->count();
        $data['countMobil'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->whereDate('parkir_keluars.created_at',date('Y-m-d'))
        ->where('jenis_kendaraans.nama_kendaraan','Mobil')
        ->get()->count();
        $data['countTruck'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->whereDate('parkir_keluars.created_at',date('Y-m-d'))
        ->where('jenis_kendaraans.nama_kendaraan','Truck')
        ->get()->count();

        // disini adalah code untuk menghitung pendapatan dari parkir keluar berdasarkan hari inii dengan status dara yang sudah bayar kemudian kita sum atau kita jumlah column nominalnya 
        $data['pendapatan'] = ParkirKeluar::whereDate('created_at',date('Y-m-d'))->where('status','Sudah Bayar')->get()->sum('nominal');
       

        // disni code nya sama seperti diatas tapi disini tidak di filter berdasarkan jenis nya karna data yang ditampilkan itu data keseluruhan di table dashboard 
        $data['parkirKeluar'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->whereDate('parkir_keluars.created_at',date('Y-m-d'))
        ->get();


        // disini kita atur view halaman dashboard nya dengan membawa data yang sudah kita buat diatas 
        return view('dashboard.index', $data);
        // ini artinya di folder dashboard trs nama file nya index
    }

    public function export() 
    {
        // disini fungsi untuk export laporan yang auto download dengan nama file Laporan.xlsx
        return Excel::download(new Laporan, 'Laporan.xlsx');
    }


 
}
