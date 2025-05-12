<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil data yang diperlukan untuk dashboard
        $totalUniversitas = 171;
        $totalProgramStudi = 973;
        $totalMahasiswa = 176430;
        $totalDosen = 8879;
        
        // Grafik data (simulasi)
        $universitas = ['Sumatera Selatan', 'Lampung', 'Bengkulu', 'Bangka Belitung'];
        $jumlahMahasiswa = [85, 61, 15, 10];
        
        // Mengembalikan tampilan dashboard dengan data yang diperlukan
        return view('home', compact(
            'totalUniversitas',
            'totalProgramStudi',
            'totalMahasiswa',
            'totalDosen',
            'universitas',
            'jumlahMahasiswa'
        ));
    }

    public function blank()
    {
        return view('layouts.blank-page');
    }
}
