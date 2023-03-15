<?php

namespace App\Http\Controllers;

use App\Models\MasterRw;
use Illuminate\Http\Request;

class MasterRwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Master RW';
        $data['breadcumb'] = 'Master RW';
        $data['rw'] = MasterRw::orderby('id', 'asc')->get();

        return view('master-rw.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Master RW';
        $data['breadcumb'] = 'Master RW';

        return view('master-rw.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new MasterRw();
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-rw-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterRw  $masterRw
     * @return \Illuminate\Http\Response
     */
    public function show(MasterRw $masterRw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterRw  $masterRw
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Master RW';
        $data['breadcumb'] = 'Master RW';
        $data['rw'] = MasterRw::find($id);

        return view('master-rw.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterRw  $masterRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MasterRw::find($id);
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-rw-list')->with(['success' => 'successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterRw  $masterRw
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MasterRw::find($id);
        $data->delete();

        return redirect()->route('master-rw-list')->with(['success' => 'successfully!']);

    }
}
