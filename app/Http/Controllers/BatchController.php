<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['batch'] = Batch::where('nama', 'like', "%{$search}%")->get();
        } else {
            $data['batch'] = Batch::all();
        }
        return view('layouts.batch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.batch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'range_awal' => 'required',
            'range_akhir' => 'required',
        ]);

            $batch = new Batch();
            $batch->nama = $request->nama;
            $batch->range_awal = $request->range_awal;
            $batch->range_akhir = $request->range_awal;
            if ($batch->save()) {
                return redirect()->route('batch.index')->with('message', 'Data Batch Berhasil Dibuat.');
            } else {
                return redirect()->back()->with('error', 'Gagal Menambah Data Batch.');
            }
            return redirect()->route('batch.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $batch = Batch::find($id);

        return view('layouts.batch.edit', compact('batch'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $batch = Batch::find($id);
    if (!$batch) {
        return redirect()->back()->with('error', 'Data Batch tidak ditemukan');
    }

    try {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'range_awal' => 'required|date',
            'range_akhir' => 'required|date',
        ]);

        $batch->nama = $request->nama;
        $batch->range_awal = $request->range_awal;
        $batch->range_akhir = $request->range_akhir;
        $batch->save();

        return redirect()->route('batch.index')->with('message', 'Edit Data Berhasil');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Edit Data Gagal');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);
        if (!$batch) {
            return redirect()->back()->with('error', 'Batch tidak ditemukan');
        }
    
        try {
            $batch->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }
    
        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('batch.index');
    }
}
