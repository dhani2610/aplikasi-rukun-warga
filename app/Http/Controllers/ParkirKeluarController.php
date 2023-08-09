<?php

namespace App\Http\Controllers;

use App\Models\ParkirKeluar;
use App\Models\ParkirMasuk;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;
use DB;
class ParkirKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Parkir Keluar';
        $data['breadcumb'] = 'Parkir Keluar';

        // disini adalah code untuk get data parkir keluar dengan berleasi join ke table parkir masuk dan table jenis kendaraan 
        $data['parkirKeluar'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->whereDate('parkir_keluars.created_at',date('Y-m-d'))
        ->get();

        // disni kita lakukan get data parkir masuk untuk input manual yang ada di modal 
        $data['parkirMasuk'] = ParkirMasuk::get();


        // disni kita return ke view data yang sudah kita get diatas 
        return view('parkir-keluar.multiple-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // disini adalah fungsi parkir keluar 

        // pertama kita cari dulu data parkir yang ingin melakukan parkir keluar berdasarkan request no_parkir dari view 
        $idParkir = ParkirMasuk::where('no_parkir',$request->no_parkir)->first();

        // disini kita juga cek data jenis kendaraan yang ingin parkir keluar 
        $cek = JenisKendaraan::where('id',$idParkir->jenis_id)->first();
       

        // disini kita buat code untuk menentukan data parkir tersebut sudah berapa menit 
        // disini kita strtotime tanggal dan waktu masuk data perkir 
        $to_time = strtotime($idParkir->created_at);
        // kemudian disini kita define waktu dan tanggal dilakukan nya action parkir keluar
        $from_time = strtotime(date('Y-m-d H:i:s'));

        // kemudian disini kita lakukan perhitungan pengurangan dari tanggal dan waktu parkir keluar dikurang tanggal dan waktu parkir masuk 
        // kemudian hasilnya di bagi 60 
        // hasil penjumlahan tersebut kita bulatkan dengan round 
        $menit = round(abs($to_time - $from_time) / 60);

        // motor 

        // kemudian disini kita cek tarif nya 
        if ($menit <= 60) {
            // jika jumlah menit nya kurang dari 60 menit 

            // disini kita cek lagi jumlah tarif nya.. karna kurang dari 60 menit maka  tarif yg dipakai adalah tarif 1 
            if ($cek->tarif_1 == null) {
                // jika tarif 1 nya kosong maka tarif parkirnya akan di difine 0 atau gratis 
                $tarif = 0;
            }else {
                // jika tarif 1 nya tidak kosong maka tarifnya akan disesuaikan dengan data tarif tersebut
                $tarif = $cek->tarif_1;
            }
        }elseif (($menit > 60) && ($menit <= 120)) {
            // jika jumlah menit nya 60 - 120  menit 
            if ($cek->tarif_2 == null) {
                // jika tarif 2 nya kosong maka tarif parkirnya akan di difine 0 atau gratis 
                $tarif = 0;
            }else {
                // jika tarif 2 nya tidak kosong maka tarifnya akan disesuaikan dengan data tarif tersebut
                $tarif = $cek->tarif_2;
            }
        }elseif (($menit > 120) && ($menit <= 180)) {
            // jika jumlah menit nya 120 - 180  menit 
            if ($cek->tarif_3 == null) {
                // jika tarif 3 nya kosong maka tarif parkirnya akan di difine 0 atau gratis 
                $tarif = 0;
            }else {
                // jika tarif 3 nya tidak kosong maka tarifnya akan disesuaikan dengan data tarif tersebut
                $tarif = $cek->tarif_3;
            }
        }elseif (($menit > 180) && ($menit <= 1440)) {
            // jika jumlah menit nya 180 - 1440  menit 
            if ($cek->tarif_4 == null) {
                // jika tarif 4 nya kosong maka tarif parkirnya akan di difine 0 atau gratis 
                $tarif = 0;
            }else {
                // jika tarif 4 nya tidak kosong maka tarifnya akan disesuaikan dengan data tarif tersebut
                $tarif = $cek->tarif_4;
            }
        }

        // disini fungsi save data parkir keluar 

        $data = new ParkirKeluar();
        $data->id_parkir_masuk = $idParkir->id;
        $data->nominal = $tarif;
        $data->status = 'Belum Bayar';
        $data->created_at = date('Y-m-d H:i:s');
        $data->save();

        // jika data berhasil di save maka akan redirect ke halaman detail parkir data tersebut dengan msg successfully! 
        return redirect()->route('detail-parkir',$data->id)->with(['success' => 'successfully!']);

    }

    public function detail($id){
           
        $data['page_title'] = 'Parkir Keluar';
        $data['breadcumb'] = 'Parkir Keluar';

        // disini adalah fungsi untuk get data detail parkir keluar berdasarkan id parkir tersebut dengan berelasi jon ke table parkir_masuks dan table jenis_kendaraan 
        $data['parkirKeluar'] = DB::table('parkir_keluars')
        ->join('parkir_masuks', 'parkir_masuks.id', '=', 'parkir_keluars.id_parkir_masuk')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_keluars.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan','parkir_masuks.no_parkir as no_parkir','parkir_masuks.id as id_parkir_masuk','parkir_masuks.created_at as jam_masuk','parkir_masuks.plat_nomor as plat_nomor','parkir_masuks.merek_kendaraan as merek_kendaraan','parkir_masuks.warna_kendaraan as warna_kendaraan')
        ->where('parkir_keluars.id',$id)
        ->first();
        // disini kita return view  data diatas ke halaman detail parkir 
        return view('parkir-keluar.multiple-multiple', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkirKeluar  $parkirKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(ParkirKeluar $parkirKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkirKeluar  $parkirKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkirKeluar $parkirKeluar)
    {
        //
    }       

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkirKeluar  $parkirKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkirKeluar $parkirKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkirKeluar  $parkirKeluar
     * @return \Illuminate\Http\Response
     */
    // disini fungsi hapus data parkir keluar berdasarkan id
    public function destroy($id)
    {
        $data = ParkirKeluar::find($id);
        $data->delete();

        return redirect()->route('parkir-keluar-list')->with(['success' => 'successfully!']);
    }

    // disini fungsi bayar parkir keluar 
    public function bayar($id)
    {
        $data = ParkirKeluar::find($id);
        $data->status = 'Sudah Bayar';
        $data->save();

        return redirect()->route('parkir-keluar-list')->with(['success' => 'successfully!']);
    }
}
