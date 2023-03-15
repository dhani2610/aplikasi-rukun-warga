<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
Use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Slider Management';
        $data['breadcumb'] = 'Slider Management';
        $data['slider'] = Slider::orderby('id', 'asc')->get();

        return view('slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Slider Management';
        $data['breadcumb'] = 'Slider Management';
        $data['slider'] = Slider::orderby('id', 'asc')->get();

        return view('slider.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Slider();
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/slider/');
            $image->move($destinationPath, $name);
            $data->foto = $name;
        }

        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('slider-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Slider Management';
        $data['breadcumb'] = 'Slider Management';
        $data['slider'] = Slider::find($id);

        return view('slider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Slider::find($id);
        if ($request->hasFile('foto')) {
            if ($data->foto) {
                $image_path = public_path('img/slider/'.$data->foto); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            

            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/slider/');
            $image->move($destinationPath, $name);
            $data->foto = $name;
        }

        $data->aktif = $request->aktif;
        $data->save();

        return redirect()->route('slider-list')->with(['success' => 'successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Slider::find($id);
        $data->delete();

        return redirect()->route('slider-list')->with(['success' => 'successfully!']);
    }
}
