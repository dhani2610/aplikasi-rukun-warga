<?php

namespace App\Http\Controllers;

use App\Models\MasterRt;
use App\Models\MasterRw;
use Illuminate\Http\Request;

class MasterRtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Master RT';
        $data['breadcumb'] = 'Master RT';
        $data['rt'] = MasterRt::orderby('id', 'asc')->get();

        return view('master-rt.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Master RT';
        $data['breadcumb'] = 'Master RT';
        $data['rw'] = MasterRw::where('aktif','Ya')->orderby('id', 'asc')->get();

        return view('master-rt.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new MasterRt();
        $data->id_rw = $request->id_rw;
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-rt-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterRt  $masterRt
     * @return \Illuminate\Http\Response
     */
    public function show(MasterRt $masterRt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterRt  $masterRt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Master RT';
        $data['breadcumb'] = 'Master RT';
        $data['rt'] = MasterRt::find($id);
        $data['rw'] = MasterRw::where('aktif','Ya')->orderby('id', 'asc')->get();


        return view('master-rt.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterRt  $masterRt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MasterRt::find($id);
        $data->id_rw = $request->id_rw;
        $data->deskripsi = $request->deskripsi;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('master-rt-list')->with(['success' => 'successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterRt  $masterRt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MasterRt::find($id);
        $data->delete();

        return redirect()->route('master-rt-list')->with(['success' => 'successfully!']);

    }
}
