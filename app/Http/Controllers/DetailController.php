<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Pt;
use App\Models\Prodi;
use App\Models\Detail;
use App\Models\Provinsi;
use App\Models\Yudisium;
use Illuminate\Http\Request;
use App\Imports\DataImport; // Create your import class for handling the data.
use Maatwebsite\Excel\Facades\Excel;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $search = $request->get('search');
        // if ($search) {
        //     $data['detail'] = Detail::where('id', 'like', "%{$search}%")->get();
        // } else {
        //     $data['detail'] = Detail::all();
        // }
        $query = Detail::query();

        // Filter berdasarkan provinsi, perguruan tinggi, program studi, dan batch
        if ($request->has('provinsi') && $request->provinsi != '') {
            $query->whereHas('pt', function ($q) use ($request) {
                $q->where('id_provinsi', $request->provinsi);
            });
        }

        if ($request->has('pt') && $request->pt != '') {
            $query->where('id_pt', $request->pt);
        }

        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('id_prodi', $request->prodi);
        }

        if ($request->has('batch') && $request->batch != '') {
            // $query->where('batch_id', $request->batch);
            $query->whereHas('yudisium', function ($q) use ($request) {
                $q->where('id_batch', $request->batch);
            });
        }

        // Filter berdasarkan search (misalnya mencari berdasarkan NPM atau Nama Mahasiswa)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('npm', 'like', '%' . $searchTerm . '%')
                    ->orWhere('nama_mhs', 'like', '%' . $searchTerm . '%');
            });
        }
        $data['detail'] = $query->get();
        $data['provinsiList'] = Provinsi::all();
        $data['ptList'] = Pt::all();
        $data['prodiList'] = Prodi::all();
        $data['batchList'] = Batch::all();
        $data ['yudisiumList'] = Yudisium::all(); // Get all Yudisium records
        return view('layouts.detail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_pt = Pt::all();
        $data_prodi = Prodi::all();
        $data_yudisium = Yudisium::all();
        $data_batch = Batch::all();
        return view('layouts.detail.create', compact('data_pt', 'data_prodi', 'data_yudisium', 'data_batch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_yudisium' => 'required',
            'id_pt' => 'required',
            'id_prodi' => 'required',
            'jenjang' => 'required',
            'id_batch' => 'required',
            'npm' => 'required',
            'nama_mhs' => 'required',
            'ipk' => 'required',
            'jml_sks' => 'required',
            'tgl_masuk' => 'required',
            'tgl_lulus' => 'required',
            'jk' => 'required',
        ]);

        $detail = new Detail();
        $detail->id_yudisium = $request->id_yudisium;
        $detail->id_pt = $request->id_pt;
        $detail->id_prodi = $request->id_prodi;
        $detail->jenjang = $request->jenjang;
        $detail->id_batch = $request->id_batch;
        $detail->npm = $request->npm;
        $detail->nama_mhs = $request->nama_mhs;
        $detail->ipk = $request->ipk;
        $detail->jml_sks = $request->jml_sks;
        $detail->tgl_masuk = $request->tgl_masuk;
        $detail->tgl_lulus = $request->tgl_lulus;
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
        $data_yudisium = Yudisium::all();
        $data_batch = Batch::all();
        return view('layouts.detail.edit', compact('detail', 'data_pt', 'data_prodi', 'data_yudisium', 'data_batch'));
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


            // dd($request->all());

            $validatedData = $request->validate([
                'id_yudisium' => 'required|string|max:255',
                'id_pt' => 'required|string|max:255',
                'id_prodi' => 'required|string|max:255',
                'jenjang' => 'required|string|max:255',
                'id_batch' => 'required|string|max:255',
                'npm' => 'required|string|max:255',
                'nama_mhs' => 'required|string|max:255',
                'ipk' => 'required',
                'jml_sks' => 'required|string|max:255',
                'tgl_masuk' => 'required|date',
                'tgl_lulus' => 'required|date',
                'jk' => 'required|string|max:255',
            ]);



            $detail->id_yudisium = $request->id_yudisium;
            $detail->id_pt = $request->id_pt;
            $detail->id_prodi = $request->id_prodi;
            $detail->jenjang = $request->jenjang;
            $detail->id_batch = $request->id_batch;
            $detail->npm = $request->npm;
            $detail->nama_mhs = $request->nama_mhs;
            $detail->ipk = $request->ipk;
            $detail->jml_sks = $request->jml_sks;
            $detail->tgl_masuk = $request->tgl_masuk;
            $detail->tgl_lulus = $request->tgl_lulus;
            $detail->jk = $request->jk;
            $detail->save();

            return redirect()->route('detail.index')->with('message', 'Edit Data Berhasil');
        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->with('error', 'Edit Data Gagal');
        }
    }

    public function import(Request $request)
    {
        // Validate the file and Yudisium ID
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
            'yudisium_id' => 'required|exists:yudisium,id', // Ensure the Yudisium ID exists
        ]);

        // Pass the Yudisium ID to the import process along with the file
        Excel::import(new DataImport($request->yudisium_id), $request->file('file'));

        return redirect()->back()->with('message', 'Data successfully imported!');
    }

    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');

    if (!$ids || !is_array($ids)) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
    }

    try {
        Detail::whereIn('id', $ids)->delete();
        return redirect()->back()->with('message', 'Data terpilih berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus data terpilih.');
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

    public function template(Request $request)
    {
        $search = $request->get('search');
        \Log::info('Fetching batch template', ['search' => $search]);

        $query = Detail::query();
        
        if ($search) {
            $query->where('npm', 'like', "%{$search}%")
                  ->orWhere('nama_mhs', 'like', "%{$search}%");
        }
        
        $data['detail'] = $query->get();
        
        return view('layouts.detail.template', $data);
    }
}
