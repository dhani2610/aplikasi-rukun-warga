<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Jenis Kendaraan';
        $data['breadcumb'] = 'Jenis Kendaraan';
        // disini adalah code untuk get data jenis kendaraan dari table jenis_kendaraans 
        $data['jenis'] = JenisKendaraan::get();

        // disini code untuk return view ke front end list jenis kendaraan 
        return view('jenis-kendaraan.multiple-index', $data);
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
    // disini adalah fungsi untuk save data jenis kendaraan 
    public function store(Request $request)
    {
        // disini code untuk validsai request dari halaman view tambah jenis kendaraan 
        // required ini artinya tidak boleh kosong
        $validateData = $request->validate([
            'nama_kendaraan'   => 'required|string|min:3',
            'tarif_1' => 'required',
            'tarif_2' => 'required',
            'tarif_3' => 'nullable',
            'tarif_4' => 'nullable',
            'keterangan' => 'required',
         
        ]);

        // disini adalah code untuk save data nya 
        $jenis = new JenisKendaraan();
        $jenis->nama_kendaraan = $validateData['nama_kendaraan'];
        $jenis->tarif_1 = $validateData['tarif_1'];
        $jenis->tarif_2 = $validateData['tarif_2'];
        $jenis->tarif_3 = $validateData['tarif_3'];
        $jenis->tarif_4 = $validateData['tarif_4'];
        $jenis->keterangan = $validateData['keterangan'];
        $jenis->save();

        // jika berhasil di save maka akan redirect ke halaman list jenis kendaraaan dengan msg addedd successfully 
        return redirect()->route('jenis-kendaraan-list')->with(['success' => 'added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisKendaraan  $jenisKendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisKendaraan $jenisKendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisKendaraan  $jenisKendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKendaraan $jenisKendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisKendaraan  $jenisKendaraan
     * @return \Illuminate\Http\Response
     */
    // inii adalah fungsi untuk update data by id 
    public function update(Request $request, $id)
    {
        // ini sama kaya tadi validasi request 
           // disini code untuk validsai request dari halaman view tambah jenis kendaraan 
        // required ini artinya tidak boleh kosong
        $validateData = $request->validate([
            'nama_kendaraan'   => 'required|string|min:3',
            'tarif_1' => 'required',
            'tarif_2' => 'required',
            'tarif_3' => 'nullable',
            'tarif_4' => 'nullable',
            'keterangan' => 'required',
         
        ]);

        // disini adalah code untuk update data by id 
        $jenis = JenisKendaraan::find($id);
        $jenis->nama_kendaraan = $validateData['nama_kendaraan'];
        $jenis->tarif_1 = $validateData['tarif_1'];
        $jenis->tarif_2 = $validateData['tarif_2'];
        $jenis->tarif_3 = $validateData['tarif_3'];
        $jenis->tarif_4 = $validateData['tarif_4'];
        $jenis->keterangan = $validateData['keterangan'];
        // disini adalah code untuk save data 
        // dalam fungsi crud wajib ada function ini 
        $jenis->save();

        // jika update berhasil maka akan diarahkan ke halaman jenis kendaraan list dengan msg Edited successfully
        return redirect()->route('jenis-kendaraan-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisKendaraan  $jenisKendaraan
     * @return \Illuminate\Http\Response
     */
    // disini adalah function untuk hapus data jenis kendaraan by id 
    // $id ini adalah request id dari view 
    public function destroy($id)
    {
        
        $jenis = JenisKendaraan::find($id);
        // ini adalah function untuk delete data 
        $jenis->delete();


        // jika berhasil delete maka akan diarahkan ke halamanan jenis kendaraan list dengan msg Deleted successfully
        return redirect()->route('jenis-kendaraan-list')->with(['success' => 'Deleted successfully!']);
    }
}
