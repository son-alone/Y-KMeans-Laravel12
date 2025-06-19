<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

class AlgoritmaController extends Controller
{

    public function mulai(Request $request)
    {
        $id_prodi = 9;
        $jenjang = "All";
        $id_batch = "All";
        $num_cluster = 3;

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


        // Parameters
        $k = 3; // Number of clusters

        // Run K-Means
        $result = $this->kMeans($data, $k);

        // Output centroids and clusters
        echo "Centroids:\n";
        print_r($result['centroids']);

        echo "\nClusters:\n";
        print_r($result['clusters']);

        // Debug hasil cluster
        dd($result);

        // dd($data_detail->get());
    }

    function euclideanDistance($point1, $point2)
    {
        $sum = 0;
        foreach ($point1 as $index => $value) {
            $sum += pow($value - $point2[$index], 2);
        }
        return sqrt($sum);
    }

    function kMeans($data, $k, $maxIterations = 100)
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
                    $numFeatures = count($cluster[0]);
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
            if ($centroids === $newCentroids) {
                break;
            }

            $centroids = $newCentroids;
            $clusters = $newClusters;
        }

        return array('centroids' => $centroids, 'clusters' => $clusters);
    }
}
