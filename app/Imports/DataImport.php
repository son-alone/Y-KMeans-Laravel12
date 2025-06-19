<?php

namespace App\Imports;

use App\Models\Detail;
use App\Models\Prodi;
use App\Models\YourModel; // Make sure to import the model where you want to store the data
use App\Models\Yudisium;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    protected $yudisium_id;

    // Constructor to receive Yudisium ID
    public function __construct($yudisium_id)
    {
        $this->yudisium_id = $yudisium_id;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
public function model(array $row)
{
    if ($row) {
        $yudisium = Yudisium::find($this->yudisium_id);
        if (!$yudisium) {
            // Jika yudisium tidak ditemukan, hentikan proses
            return null;
        }

        $prodi = Prodi::where('nama', '=', $row['prodi'] ?? '')->first();
        if (!$prodi) {
            // Jika prodi tidak ditemukan, hentikan proses
            return null;
        }

        // Proteksi format tanggal masuk
        try {
            $tgl_masuk = isset($row['tgl_masuk']) && !empty($row['tgl_masuk']) 
                ? Carbon::createFromFormat('d/m/Y', $row['tgl_masuk'])->format('Y-m-d') 
                : null;
        } catch (\Exception $e) {
            $tgl_masuk = null; // atau bisa lempar error sesuai kebutuhan
        }

        // Proteksi format tanggal lulus
        try {
            $tgl_lulus = isset($row['tgl_lulus']) && !empty($row['tgl_lulus']) 
                ? Carbon::createFromFormat('d/m/Y', $row['tgl_lulus'])->format('Y-m-d') 
                : null;
        } catch (\Exception $e) {
            $tgl_lulus = null;
        }

        $ipk = isset($row['ipk']) ? floatval($row['ipk']) : 0;
        if ($ipk <= 0 || $ipk > 4) {
            throw new \Exception('Nilai IPK harus dalam rentang 0 - 4.');
        }

        return new Detail([
            'id_yudisium' => $this->yudisium_id,
            'id_pt' => $yudisium->id_pt,
            'id_batch' => $yudisium->id_batch,
            'jenjang' => $row['jenjang'] ?? null,
            'id_prodi' => $prodi->id,
            'npm' => $row['npm'] ?? null,
            'nama_mhs' => $row['nama_mhs'] ?? null,
            'ipk' => $ipk,
            'jml_sks' => $row['jml_sks'] ?? null,
            'tgl_masuk' => $tgl_masuk,
            'tgl_lulus' => $tgl_lulus,
            'jk' => $row['jk'] ?? null,
        ]);
    }
    return null;
}

}
