<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['prodi'] = Prodi::where('nama', 'like', "%{$search}%")
                ->orderBy('nama', 'asc')  // Menambahkan pengurutan berdasarkan nama abjad
                ->get();
        } else {
            $data['prodi'] = Prodi::orderBy('nama', 'asc')  // Menambahkan pengurutan berdasarkan nama abjad
                ->get();
        }
    
        return view('layouts.prodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

            $prodi = new Prodi();
            $prodi->nama = $request->nama;
            $prodi->keterangan = $request->keterangan;
            if ($prodi->save()) {
                return redirect()->route('prodi.index')->with('message', 'Data Prodi Berhasil Dibuat.');
            } else {
                return redirect()->back()->with('error', 'Gagal Menambah Data Prodi.');
            }
            return redirect()->route('prodi.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $prodi = Prodi::find($id);

        return view('layouts.prodi.edit', compact('prodi'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $prodi = Prodi::find($id);
    if (!$prodi) {
        return redirect()->back()->with('error', 'Data Prodi tidak ditemukan');
    }

    try {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $prodi->nama = $request->nama;
        $prodi->keterangan = $request->keterangan;
        $prodi->save();

        return redirect()->route('prodi.index')->with('message', 'Edit Data Berhasil');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Edit Data Gagal');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return redirect()->back()->with('error', 'Prodi tidak ditemukan');
        }
    
        try {
            $prodi->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }
    
        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('prodi.index');
    }
}
