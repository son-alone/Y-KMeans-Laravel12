<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Pt;
use App\Models\Prodi;
use App\Models\Provinsi;
use App\Models\Yudisium;
use App\Models\Detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use Phpml\Clustering\KMeans\Cluster;

class ClusteringController extends Controller
{

    public function mulai_old(Request $request)
    {
        $id_prodi = $request->id_prodi;
        $jenjang = $request->jenjang;
        $id_batch = $request->id_batch;
        $num_cluster = $request->num_cluster;

        $data_detail = Detail::where('id_prodi', '=', $id_prodi);
        if ($jenjang != 'All') {
            $data_detail = $data_detail->where('jenjang', '=', $jenjang);
        }

        if ($id_batch != 'All') {
            $data_detail = $data_detail->where('id_batch', '=', $id_batch);
        }

        // Ambil data dari tabel Detail
        $details = $data_detail->get(['id', 'ipk', 'jml_sks', 'tgl_masuk', 'tgl_lulus']);

        // Proses data: Hitung waktu kuliah dan persiapkan data untuk clustering
        $data = [];
        foreach ($details as $detail) {
            // Menghitung waktu kuliah (dalam tahun)
            $tgl_masuk = Carbon::parse($detail->tgl_masuk);
            $tgl_lulus = Carbon::parse($detail->tgl_lulus);
            $waktu_kuliah = $tgl_masuk->diffInYears($tgl_lulus);  // Menghitung waktu kuliah dalam tahun

            // Persiapkan data untuk clustering: IPK, jumlah SKS, dan waktu kuliah
            $data[] = [
                $detail->ipk,           // IPK
                $detail->jml_sks,       // Jumlah SKS
                $waktu_kuliah,          // Waktu Kuliah (dalam tahun)
                $detail->id
            ];
        }
        // dd($data);


        // Parameters
        $k = 3; // Number of clusters

        // Run K-Means
        $result = $this->kMeans($data, $k);

        // Output centroids and clusters
        // echo "Centroids:\n";
        // print_r($result['centroids']);

        // echo "\nClusters:\n";
        // print_r($result['clusters']);

        // Debug hasil cluster
        // dd($result);

        return view('layouts.clustering_result', [
            'centroids' => $result['centroids'],
            'clusters' => $result['clusters']
        ]);

        // dd($data_detail->get());
    }

    public function mulai(Request $request)
    {
        $id_prodi = $request->id_prodi;
        $jenjang = $request->jenjang;
        $id_batch = $request->id_batch;
        $num_cluster = $request->num_cluster;

        $data_detail = Detail::where('id_prodi', '=', $id_prodi);
        if ($jenjang != 'All') {
            $data_detail = $data_detail->where('jenjang', '=', $jenjang);
        }

        if ($id_batch != 'All') {
            $data_detail = $data_detail->where('id_batch', '=', $id_batch);
        }

        // Ambil data dari tabel Detail
        $details = $data_detail->get();

        $max_ipk = 4; // IPK biasanya antara 0-4
        $max_sks = $details->max('jml_sks'); // Cari jumlah SKS maksimum dalam dataset
        $max_waktu_kuliah = $details->max(function ($detail) {
            $tgl_masuk = Carbon::parse($detail->tgl_masuk);
            $tgl_lulus = Carbon::parse($detail->tgl_lulus);
            return $tgl_masuk->diffInYears($tgl_lulus); // Hitung waktu kuliah
        });

        $data = [];
        foreach ($details as $detail) {
            // Menghitung waktu kuliah (dalam tahun)
            $tgl_masuk = Carbon::parse($detail->tgl_masuk);
            $tgl_lulus = Carbon::parse($detail->tgl_lulus);
            $waktu_kuliah = $tgl_masuk->diffInYears($tgl_lulus);  // Menghitung waktu kuliah dalam tahun

            // Normalisasi data
            $normalized_ipk = $detail->ipk / $max_ipk; // Normalisasi IPK dengan membagi dengan nilai maksimum (4)
            $normalized_sks = $detail->jml_sks / $max_sks; // Normalisasi SKS dengan membagi dengan nilai maksimum SKS
            $normalized_waktu_kuliah = 1 - ($waktu_kuliah / $max_waktu_kuliah); // Normalisasi Waktu Kuliah (1 - nilai untuk waktu cepat lebih baik)

            // Persiapkan data untuk clustering: IPK, jumlah SKS, dan waktu kuliah
            $data[] = [
                $normalized_ipk,           // Normalized IPK
                $normalized_sks,           // Normalized Jumlah SKS
                $normalized_waktu_kuliah,  // Normalized Waktu Kuliah
                $detail->id,
                $detail->ipk,
                $detail->jml_sks,
                $waktu_kuliah,
                $detail->npm,
                $detail->nama_mhs,
                $detail->Pt->nama_pt
            ];
            // dd($data);
        }

        // Parameters
        $k = $num_cluster; // Jumlah cluster sesuai input

if (count($data) === 0) {
    return redirect()->back()->with('error', 'Data tidak ditemukan untuk parameter yang dipilih.');
}

if ($k < 1) {
    return redirect()->back()->with('error', 'Jumlah cluster minimal harus 1.');
}

if ($k > count($data)) {
    return redirect()->back()->with('error', 'Jumlah cluster tidak boleh melebihi jumlah data yang tersedia.');
}

        // Run K-Means
        $result = $this->kMeans($data, $k);
        // dd($result['centroids']);

        // Kirim hasil ke view
        return view('layouts.cluster.clustering_result', [
            'centroids' => $result['centroids'],
            'clusters' => $result['clusters']
        ]);
    }


    function euclideanDistance($point1, $point2)
    {
        $sum = 0;
        $nomor = 0;
        foreach ($point1 as $index => $value) {
            if ($nomor < 3) {
                $sum += pow($value - $point2[$index], 2);
            }
            $nomor++;
        }
        return sqrt($sum);
    }

    function kMeans($data, $k, $maxIterations = 1000)
    {
        $centroids = array();
        $clusters = array();

        // Step 1: Randomly initialize centroids
        $randomIndexes = array_rand($data, $k);
        foreach ($randomIndexes as $index) {
            $centroids[] = $data[$index];
        }

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            // Step 2: Assign data points to the nearest centroid
            $newClusters = array_fill(0, $k, array());
            foreach ($data as $point) {
                $distances = array();
                foreach ($centroids as $centroid) {
                    $distances[] = $this->euclideanDistance($point, $centroid);
                }
                $closestCentroidIndex = array_search(min($distances), $distances);
                $newClusters[$closestCentroidIndex][] = $point;
            }

            // Step 3: Recalculate centroids
            $newCentroids = array();
            foreach ($newClusters as $cluster) {
                if (count($cluster) > 0) {
                    $newCentroid = array();
                    $numPoints = count($cluster);
                    $numFeatures = count($cluster[0]) - 3;
                    for ($i = 0; $i < $numFeatures; $i++) {
                        $sum = 0;
                        foreach ($cluster as $point) {
                            $sum += $point[$i];
                        }
                        $newCentroid[] = $sum / $numPoints;
                    }
                    $newCentroids[] = $newCentroid;
                }
            }

            // Check for convergence (no change in centroids)
            // if ($centroids === $newCentroids) {
            //     break;
            // }

            $centroids = $newCentroids;
            $clusters = $newClusters;
        }

        return array('centroids' => $centroids, 'clusters' => $clusters);
    }

    public function cluster()
    {

        $data_pt = Pt::all();
        $data_prodi = Prodi::all();
        $data_yudisium = Yudisium::all();
        $data_batch = Batch::all();
        return view('layouts.cluster.clustering', compact('data_pt', 'data_prodi', 'data_yudisium', 'data_batch'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster)
    {
        //
    }
}
