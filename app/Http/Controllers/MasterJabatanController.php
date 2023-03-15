<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use Illuminate\Http\Request;

class MasterJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Master Jabatan';
        $data['breadcumb'] = 'Master Jabatan';
        $data['jabatan'] = MasterJabatan::orderby('id', 'asc')->get();

        return view('master-jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Master Jabatan';
        $data['breadcumb'] = 'Master Jabatan';

        return view('master-jabatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new MasterJabatan();
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-jabatan-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterJabatan  $masterJabaMasterJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJabatan $masterJabaMasterJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJabatan  $masterJabaMasterJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Master Jabatan';
        $data['breadcumb'] = 'Master Jabatan';
        $data['jabatan'] = MasterJabatan::find($id);

        return view('master-jabatan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJabatan  $masterJabaMasterJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MasterJabatan::find($id);
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-jabatan-list')->with(['success' => 'successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJabatan  $masterJabaMasterJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MasterJabatan::find($id);
        $data->delete();

        return redirect()->route('master-jabatan-list')->with(['success' => 'successfully!']);

    }
}
