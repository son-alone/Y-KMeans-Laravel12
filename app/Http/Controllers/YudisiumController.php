<?php

namespace App\Http\Controllers;

use App\Models\yudisium;
use Illuminate\Http\Request;

class YudisiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['yudisium'] = yudisium::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['yudisium'] = yudisium::all();
        }
        return view('layouts.yudisium.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.yudisium.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_batch' => 'required',
            'id_pt' => 'required',
            'tanggal_yudisium' => 'required',
            'tanggal_verifikasi' => 'required',
            'id_verifikator' => 'required',
        ]);

        $yudisium = new yudisium();
        $yudisium->id_batch = $request->id_batch;
        $yudisium->id_pt = $request->id_pt;
        $yudisium->tanggal_yudisium = $request->tanggal_yudisium;
        $yudisium->tanggal_verifikasi = $request->tanggal_verifikasi;
        $yudisium->id_verifikator = $request->id_verifikator;
        if ($yudisium->save()) {
            return redirect()->route('yudisium.index')->with('message', 'Data Yudisium Berhasil Dibuat.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambah Data Yudisium.');
        }
        return redirect()->route('yudisium.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(yudisium $yudisium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $yudisium = yudisium::find($id);

        return view('layouts.yudisium.edit', compact('yudisium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $yudisium = yudisium::find($id);
        if (!$yudisium) {
            return redirect()->back()->with('error', 'Data Yudisium tidak ditemukan');
        }

        try {
            $validatedData = $request->validate([
                'id_batch' => 'required|string|max:255',
                'id_pt' => 'required|string|max:255',
                'tanggal_yudisium' => 'required|date',
                'tanggal_verifikasi' => 'required|date',
                'id_verifikator' => 'required|string|max:255',
            ]);

            $yudisium->id_batch = $request->id_batch;
            $yudisium->id_pt = $request->id_pt;
            $yudisium->tanggal_yudisium = $request->tanggal_yudisium;
            $yudisium->tanggal_verifikasi = $request->tanggal_verifikasi;
            $yudisium->id_verifikator = $request->id_verifikator;
            $yudisium->save();

            return redirect()->route('yudisium.index')->with('message', 'Edit Data Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Edit Data Gagal');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $yudisium = yudisium::find($id);
        if (!$yudisium) {
            return redirect()->back()->with('error', 'Yudisium tidak ditemukan');
        }

        try {
            $yudisium->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }

        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('yudisium.index');
    }
}
