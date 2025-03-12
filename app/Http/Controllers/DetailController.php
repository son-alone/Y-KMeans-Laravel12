<?php

namespace App\Http\Controllers;

use App\Models\detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['detail'] = detail::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['detail'] = detail::all();
        }
        return view('layouts.detail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.detail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'id_yudisium' => 'required',
        'id_prodi' => 'required',
        'npm' => 'required',
        'nama_mhs' => 'required',
        'ipk' => 'required',
        'jml_sks' => 'required',
        'tgl_masuk' => 'required',
        'jk' => 'required',
        ]);

        $detail = new detail();
        $detail->id_yudisium = $request->id_yudisium;
        $detail->id_prodi = $request->id_prodi;
        $detail->npm = $request->npm;
        $detail->nama_mhs = $request->nama_mhs;
        $detail->ipk = $request->ipk;
        $detail->jml_sks = $request->jml_sks;
        $detail->tgl_masuk = $request->tgl_masuk;
        $detail->jk = $request->jk;
        if ($detail->save()) {
            return redirect()->route('detail.index')->with('message', 'Data Detail Yudisium Berhasil Dibuat.');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambah Data Detail Yudisium.');
        }
        return redirect()->route('detail.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $detail = detail::find($id);

        return view('layouts.detail.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detail = detail::find($id);
        if (!$detail) {
            return redirect()->back()->with('error', 'Data Detail Yudisium tidak ditemukan');
        }

        try {
            $validatedData = $request->validate([
        'id_yudisium' => 'required|string|max:255',
        'id_prodi' => 'required|string|max:255',
        'npm' => 'required|string|max:255',
        'nama_mhs' => 'required|string|max:255',
        'ipk' => 'required|double',
        'jml_sks' => 'required|string|max:255',
        'tgl_masuk' => 'required|date',
        'jk' => 'required|string|max:255',
            ]);

        $detail->id_yudisium = $request->id_yudisium;
        $detail->id_prodi = $request->id_prodi;
        $detail->npm = $request->npm;
        $detail->nama_mhs = $request->nama_mhs;
        $detail->ipk = $request->ipk;
        $detail->jml_sks = $request->jml_sks;
        $detail->tgl_masuk = $request->tgl_masuk;
        $detail->jk = $request->jk;
        $detail->save();

            return redirect()->route('detail.index')->with('message', 'Edit Data Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Edit Data Gagal');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = detail::find($id);
        if (!$detail) {
            return redirect()->back()->with('error', 'Detail Yudisium tidak ditemukan');
        }

        try {
            $detail->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }

        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('detail.index');
    }
}
