<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Pt;
use App\Models\Yudisium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YudisiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['yudisium'] = Yudisium::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['yudisium'] = Yudisium::all();
        }
        return view('layouts.yudisium.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_batch = Batch::all();
        $data_pt = Pt::all();
        return view('layouts.yudisium.create', compact('data_batch', 'data_pt'));
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
            'file' => 'required',
        ]);

        $yudisium = new Yudisium();
        $yudisium->id_batch = $request->id_batch;
        $yudisium->id_pt = $request->id_pt;
        $yudisium->tanggal_yudisium = $request->tanggal_yudisium;
        $yudisium->file = $request->file;
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
    public function show(Yudisium $yudisium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $yudisium = Yudisium::find($id);

        $data_batch = Batch::all();
        $data_pt = Pt::all();
        return view('layouts.yudisium.edit', compact('yudisium', 'data_batch', 'data_pt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $yudisium = Yudisium::find($id);
        if (!$yudisium) {
            return redirect()->back()->with('error', 'Data Yudisium tidak ditemukan');
        }

        try {
            $validatedData = $request->validate([
                'id_batch' => 'required|string|max:255',
                'id_pt' => 'required|string|max:255',
                'tanggal_yudisium' => 'required|date',
                'file' => 'required|file',
            ]);

            $yudisium->id_batch = $request->id_batch;
            $yudisium->id_pt = $request->id_pt;
            $yudisium->tanggal_yudisium = $request->tanggal_yudisium;
            $yudisium->file = $request->file;
            $yudisium->save();

            return redirect()->route('yudisium.index')->with('message', 'Edit Data Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Edit Data Gagal');
        }
    }

    public function verifikasi($id)
    {
        // dd($id);
        // Mencari data yudisium berdasarkan ID
        $yudisium = Yudisium::find($id);

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$yudisium) {
            return redirect()->back()->with('error', 'Data Yudisium tidak ditemukan');
        }

        // Perbarui status verifikasi dan ID verifikator
        $yudisium->tanggal_verifikasi = now();  // Anda bisa menggunakan waktu sekarang atau sesuai kebutuhan
        $yudisium->id_verifikator = Auth::user()->id;  // Misalnya, menggunakan ID pengguna yang sedang login

        // Simpan perubahan
        if ($yudisium->save()) {
            return redirect()->route('yudisium.index')->with('message', 'Verifikasi berhasil');
        } else {
            return redirect()->back()->with('error', 'Verifikasi gagal');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $yudisium = Yudisium::find($id);
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
