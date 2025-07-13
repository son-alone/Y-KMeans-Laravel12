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
            $data['provinsi'] = Provinsi::where('nama_provinsi', 'like', "%{$search}%")->get();
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
            'nama_provinsi' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = null;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        }

        $provinsi = new Provinsi();
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->logo = $fileName;
        $provinsi->save();

        return redirect()->route('provinsi.index')->with('message', 'Data Provinsi Berhasil Dibuat.');
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

        $validatedData = $request->validate([
            'nama_provinsi' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $provinsi->nama_provinsi = $request->nama_provinsi;

        if ($request->hasFile('logo')) {
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads'), $fileName);
            $provinsi->logo = $fileName;
        }

        $provinsi->save();

        return redirect()->route('provinsi.index')->with('message', 'Edit Data Berhasil');
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
