<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['provinsi'] = Provinsi::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['provinsi'] = Provinsi::all();
        }
        return view('layouts.provinsi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_provinsi' => 'required',
            'logo' => 'required',
        ]);

            $provinsi = new Provinsi();
            $provinsi->nama_provinsi = $request->nama_provinsi;
            $provinsi->logo = $request->logo;
            if ($provinsi->save()) {
                return redirect()->route('provinsi.index')->with('message', 'Data Provinsi Berhasil Dibuat.');
            } else {
                return redirect()->back()->with('error', 'Gagal Menambah Data Provinsi');
            }
            return redirect()->route('provinsi.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $provinsi = Provinsi::find($id);

        return view('layouts.provinsi.edit', compact('provinsi'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $provinsi = Provinsi::find($id);
    if (!$provinsi) {
        return redirect()->back()->with('error', 'Data Provinsi tidak ditemukan');
    }

    try {
        $validatedData = $request->validate([
            'nama_provinsi' => 'required|string|max:255',
            'logo' => 'required|file',
        ]);

        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->logo = $request->logo;
        $provinsi->save();

        return redirect()->route('provinsi.index')->with('message', 'Edit Data Berhasil');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Edit Data Gagal');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) {
            return redirect()->back()->with('error', 'Provinsi tidak ditemukan');
        }
    
        try {
            $provinsi->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }
    
        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('provinsi.index');
    }
}
