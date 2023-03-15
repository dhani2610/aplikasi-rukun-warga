<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Slider;
use Illuminate\Http\Request;
use File;
class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Berita Management';
        $data['breadcumb'] = 'Berita Management';
        $data['berita'] = Berita::orderby('id', 'asc')->get();

        return view('berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Berita Management';
        $data['breadcumb'] = 'Berita Management';

        return view('berita.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Berita();
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/berita/');
            $image->move($destinationPath, $name);
            $data->foto = $name;
        }
        $data->judul = $request->judul;
        $data->isi_berita = $request->isi_berita;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('berita-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['berita'] = Berita::where('aktif','Ya')->where('id',$id)->first();
        $data['slider'] = Slider::where('aktif','Ya')->orderby('id', 'desc')->get();
        return view('landing.detail-berita', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Berita Management';
        $data['breadcumb'] = 'Berita Management';
        $data['berita'] = Berita::find($id);

        return view('berita.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Berita::find($id);
        if ($request->hasFile('foto')) {
            if ($data->foto) {
                $image_path = public_path('img/berita/'.$data->foto); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/berita/');
            $image->move($destinationPath, $name);
            $data->foto = $name;
        }
        $data->judul = $request->judul;
        $data->isi_berita = $request->isi_berita;
        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('berita-list')->with(['success' => 'successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Berita::find($id);
        if ($data->foto) {
            $image_path = public_path('img/berita/'.$data->foto); // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    
        $data->delete();

        return redirect()->route('berita-list')->with(['success' => 'successfully!']);
    }
}
