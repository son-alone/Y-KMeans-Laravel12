<?php

namespace App\Http\Controllers;

use App\Models\prodi;
use App\Models\pt;
use App\Models\ptprodi;
use Illuminate\Http\Request;

class PtprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['ptprodi'] = ptprodi::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['ptprodi'] = ptprodi::all();
        }
        return view('layouts.ptprodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_prodi = prodi::all();
        $data_pt = pt::all();
        return view('layouts.ptprodi.create',compact('data_prodi','data_pt'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pt' => 'required',
            'id_prodi' => 'required',
            'jenjang' => 'required',
            'akreditasi' => 'required',
            'sk' => 'required',
            'tanggal_berlaku' => 'required',
            'jumlah_dosen' => 'required',
            'jumlah_mahasiswa' => 'required',
        ]);

            $ptprodi = new ptprodi();
            $ptprodi->id_pt = $request->id_pt;
            $ptprodi->id_prodi = $request->id_prodi;
            $ptprodi->jenjang = $request->jenjang;
            $ptprodi->akreditasi = $request->akreditasi;
            $ptprodi->sk = $request->sk;
            $ptprodi->tanggal_berlaku = $request->tanggal_berlaku;
            $ptprodi->jumlah_dosen = $request->jumlah_dosen;
            $ptprodi->jumlah_mahasiswa = $request->jumlah_mahasiswa;
            if ($ptprodi->save()) {
                return redirect()->route('ptprodi.index')->with('message', 'Data PT Prodi Berhasil Dibuat.');
            } else {
                return redirect()->back()->with('error', 'Gagal Menambah Data PT Prodi.');
            }
            return redirect()->route('ptprodi.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(ptprodi $ptprodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $ptprodi = ptprodi::find($id);

        return view('layouts.ptprodi.edit', compact('ptprodi'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $ptprodi = ptprodi::find($id);
    if (!$ptprodi) {
        return redirect()->back()->with('error', 'Data PT Prodi tidak ditemukan');
    }

    try {
        $validatedData = $request->validate([
            'id_pt' => 'required|string|max:255',
            'id_prodi' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'akreditasi' => 'required|string|max:255',
            'sk' => 'required|string|max:255',
            'tanggal_berlaku' => 'required|date',
            'jumlah_dosen' => 'required|string|max:255',
            'jumlah_mahasiswa' => 'required|string|max:255',
        ]);

        
            $ptprodi->id_pt = $request->id_pt;
            $ptprodi->id_prodi = $request->id_prodi;
            $ptprodi->jenjang = $request->jenjang;
            $ptprodi->akreditasi = $request->akreditasi;
            $ptprodi->sk = $request->sk;
            $ptprodi->tanggal_berlaku = $request->tanggal_berlaku;
            $ptprodi->jumlah_dosen = $request->jumlah_dosen;
            $ptprodi->jumlah_mahasiswa = $request->jumlah_mahasiswa;
        $ptprodi->save();

        return redirect()->route('ptprodi.index')->with('message', 'Edit Data Berhasil');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Edit Data Gagal');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ptprodi = ptprodi::find($id);
        if (!$ptprodi) {
            return redirect()->back()->with('error', 'Prodi Perguruan Tinggi tidak ditemukan');
        }
    
        try {
            $ptprodi->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }
    
        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('ptprodi.index');
    }
}
