<?php

namespace App\Http\Controllers;

use App\Models\Pt;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $data['pt'] = Pt::where('nama_pt', 'like', "%{$search}%")->get();
        } else {
            $data['pt'] = Pt::all();
        }
        return view('layouts.pt.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_provinsi = Provinsi::all();
        return view('layouts.pt.create',compact('data_provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_provinsi' => 'required',
            'nama_pt' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'logo' => 'required',
        ]);

            $pt = new Pt();
            $pt->id_provinsi = $request->id_provinsi;
            $pt->nama_pt = $request->nama_pt;
            $pt->no_hp = $request->no_hp;
            $pt->email = $request->email;
            $pt->alamat = $request->alamat;
            $pt->logo = $request->logo;
            if ($pt->save()) {
                return redirect()->route('pt.index')->with('message', 'Data PT Berhasil Dibuat.');
            } else {
                return redirect()->back()->with('error', 'Gagal Menambah Data PT.');
            }
            return redirect()->route('pt.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(Pt $pt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $pt = Pt::find($id);

        $data_provinsi = Provinsi::all();

        return view('layouts.pt.edit', compact('pt', 'data_provinsi'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $pt = Pt::find($id);
    if (!$pt) {
        return redirect()->back()->with('error', 'Data PT tidak ditemukan');
    }

    try {
        $validatedData = $request->validate([
            'id_provinsi' => 'required|string|max:255',
            'nama_pt' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'logo' => 'required|file',
        ]);

        $pt->id_provinsi = $request->id_provinsi;
        $pt->nama_pt = $request->nama_pt;
        $pt->no_hp = $request->no_hp;
        $pt->email = $request->email;
        $pt->alamat = $request->alamat;
        $pt->logo = $request->logo;
        $pt->save();

        return redirect()->route('pt.index')->with('message', 'Edit Data Berhasil');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Edit Data Gagal');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pt = Pt::find($id);
        if (!$pt) {
            return redirect()->back()->with('error', 'Perguruan Tinggi tidak ditemukan');
        }
    
        try {
            $pt->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete data gagal');
        }
    
        session()->flash('message', 'Delete data berhasil');
        return redirect()->route('pt.index');
    }
}
