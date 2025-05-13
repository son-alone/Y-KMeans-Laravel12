<?php

namespace App\Http\Controllers;

use App\Models\Pt;
use App\Models\Prodi;
use App\Models\Detail;
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
            $data['detail'] = Detail::where('id', 'like', "%{$search}%")->get();
        } else {
            $data['detail'] = Detail::all();
        }
        return view('layouts.detail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_pt = Pt::all();
        $data_prodi = Prodi::all();
        return view('layouts.detail.create',compact('data_pt','data_prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'id_pt' => 'required',
        'id_prodi' => 'required',
        'npm' => 'required',
        'nama_mhs' => 'required',
        'ipk' => 'required',
        'jml_sks' => 'required',
        'tgl_masuk' => 'required',
        'jk' => 'required',
        ]);

        $detail = new Detail();
        $detail->id_pt = $request->id_pt;
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
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $detail = Detail::find($id);

        $data_pt = Pt::all();
        $data_prodi = Prodi::all();
        return view('layouts.detail.edit',compact('detail','data_pt','data_prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detail = Detail::find($id);
        if (!$detail) {
            return redirect()->back()->with('error', 'Data Detail Yudisium tidak ditemukan');
        }

        try {
            $validatedData = $request->validate([
        'id_pt' => 'required|string|max:255',
        'id_prodi' => 'required|string|max:255',
        'npm' => 'required|string|max:255',
        'nama_mhs' => 'required|string|max:255',
        'ipk' => 'required|double',
        'jml_sks' => 'required|string|max:255',
        'tgl_masuk' => 'required|date',
        'jk' => 'required|string|max:255',
            ]);

        $detail->id_pt = $request->id_pt;
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
        $detail = Detail::find($id);
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
