<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Mahasiswa;
use App\Services\KMeans;
use Illuminate\Http\Request;

class ClusteringController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('clustering.index', compact('provinsi'));
    }

    public function clusterMahasiswa($provinsi_id)
    {
        $provinsi = Provinsi::findOrFail($provinsi_id);
        $perguruan_tinggi = $provinsi->perguruanTinggi;

        $data_mahasiswa = Mahasiswa::whereIn('program_studi_id', $perguruan_tinggi->pluck('id'))->get();

        $data = $data_mahasiswa->map(function ($mahasiswa) {
            return [
                $mahasiswa->ipk, 
                $mahasiswa->jumlah_sks, 
                $mahasiswa->tanggal_lulus->diffInYears($mahasiswa->tanggal_masuk)
            ];
        });

        $kMeans = new KMeans(3, $data);
        $kMeans->fit();

        foreach ($data_mahasiswa as $index => $mahasiswa) {
            $mahasiswa->cluster = $kMeans->clusters[$index];
            $mahasiswa->save();
        }

        return view('clustering.results', compact('data_mahasiswa'));
    }
}
