<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use App\Models\ParkirMasuk;
use Illuminate\Http\Request;
use DB;

class ParkirMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Parkir Masuk';
        $data['breadcumb'] = 'Parkir Masuk';

        // disini fungsi untuk get data parkir masuk dengan berelasi join ke table jenis kendaraans 
        $data['parkirMasuk'] = DB::table('parkir_masuks')
        ->join('jenis_kendaraans', 'jenis_kendaraans.id', '=', 'parkir_masuks.jenis_id')
        ->select('parkir_masuks.*','jenis_kendaraans.nama_kendaraan as nama_kendaraan')
        ->whereDate('parkir_masuks.created_at',date('Y-m-d'))
        ->get();

        // disini kita melakukan geet data jenis kendaraan 
        $data['jenis'] = JenisKendaraan::get();

        // disini kita panggil fungsi generate no parkir nya 
        $data['no_parkir'] = $this->generateOrderNR();

        // disini kita lakukan return view dengan membawa data diatas 
        return view('parkir-masuk.multiple-index', $data);
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
        // disini adalah code untuk fungsi validasi setiap request nya
        // required ini artinya harus di isi atau tidak boleh kosong 
        $validateData = $request->validate([
            'no_parkir'   => 'required',
            'jenis_id' => 'required',
            'plat_nomor' => 'required',
            'merek_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
        ]);

        // disini adalah dungsi untuk menyimpan data request yg dikirimkan dari form parkir masuk 
        $jenis = new ParkirMasuk();
        $jenis->no_parkir = $validateData['no_parkir'];
        $jenis->jenis_id = $validateData['jenis_id'];
        $jenis->plat_nomor = $validateData['plat_nomor'];
        $jenis->merek_kendaraan = $validateData['merek_kendaraan'];
        $jenis->warna_kendaraan = $validateData['warna_kendaraan'];
        // disini adalah fungsi save 
        $jenis->save();

        // jika data berhasil di save maka akan masuk ke halaman list parkir dengan msg added successfully
        return redirect()->route('parkir-masuk-list')->with(['success' => 'added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkirMasuk  $parkirMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(ParkirMasuk $parkirMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkirMasuk  $parkirMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkirMasuk $parkirMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkirMasuk  $parkirMasuk
     * @return \Illuminate\Http\Response
     */
    // disini adalah fungsi untuk update data berdasarkan id 
    public function update(Request $request, $id)
    {
         // disini adalah code untuk fungsi validasi setiap request nya
        // required ini artinya harus di isi atau tidak boleh kosong 
        $validateData = $request->validate([
            'no_parkir'   => 'required',
            'jenis_id' => 'required',
            'plat_nomor' => 'required',
            'merek_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
        ]);


        // disini adalah fungsi update date berdasarkan id yang terlah di request dari view 
        $jenis = ParkirMasuk::find($id);
        $jenis->no_parkir = $validateData['no_parkir'];
        $jenis->jenis_id = $validateData['jenis_id'];
        $jenis->plat_nomor = $validateData['plat_nomor'];
        $jenis->merek_kendaraan = $validateData['merek_kendaraan'];
        $jenis->warna_kendaraan = $validateData['warna_kendaraan'];
        // disini adalah fungsi save data 
        $jenis->save();

        // jika data berhasil di save maka akan masuk ke halaman list parkir dengan msg Edited successfully
        return redirect()->route('parkir-masuk-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkirMasuk  $parkirMasuk
     * @return \Illuminate\Http\Response
     */
    // disini adalah fungsi untuk hapus data parkir masuk berdasarkan id yang dikirimkan dari view
    public function destroy($id)
    {
        // disini code untuk melakukan define data parkir masuk berdasarkan id 
        $jenis = ParkirMasuk::find($id);
        // duisini adalah fungsi untuk delete data 
        $jenis->delete();

        // jika data berhasil di delete maka akan masuk ke halaman list parkir dengan msg Deleted successfully

        return redirect()->route('parkir-masuk-list')->with(['success' => 'Deleted successfully!']);
    }


    // disini adalah fungsi untuk generate nomor parkir 
    public function generateOrderNR()
    {
        $orderObj = \DB::table('parkir_masuks')->select('no_parkir')->latest('id')->first();
        if ($orderObj) {
            $orderNr = $orderObj->no_parkir;
            $removed1char = substr($orderNr, -1,1);
            $generateOrder_nr = $stpad = 'PARKIR-' . str_pad((int)$removed1char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $generateOrder_nr = 'PARKIR-' . str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $generateOrder_nr;
    }
}
