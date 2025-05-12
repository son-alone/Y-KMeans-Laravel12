<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;  // Model Mahasiswa
use App\Models\Prodi;  // Pastikan model Prodi diimpor
use App\Models\Provinsi;  // Pastikan model Provinsi diimpor

class MahasiswaController extends Controller
{
    // Menampilkan form tambah mahasiswa
    public function create()
{
    $prodi = Prodi::all(); // Ambil semua program studi
    return view('mahasiswa.create', compact('program_studi'));
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'ipk' => 'required|numeric',
        'jumlah_sks' => 'required|integer',
        'tanggal_masuk' => 'required|date',
        'tanggal_lulus' => 'required|date',
        'program_studi_id' => 'required|exists:program_studi,id',
    ]);

    Mahasiswa::create($request->all()); // Menyimpan data mahasiswa

    return redirect('/clustering');
}

public function edit($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $prodi = Prodi::all(); // Ambil semua program studi
    return view('mahasiswa.edit', compact('mahasiswa', 'program_studis'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'ipk' => 'required|numeric',
        'jumlah_sks' => 'required|integer',
        'tanggal_masuk' => 'required|date',
        'tanggal_lulus' => 'required|date',
        'program_studi_id' => 'required|exists:program_studi,id',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->update($request->all());

    return redirect('/clustering');
}

public function destroy($id)
{
    Mahasiswa::findOrFail($id)->delete();
    return redirect('/clustering');
}
}
