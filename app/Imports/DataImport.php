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
        $yudisium = Yudisium::find($this->yudisium_id);
        $prodi = Prodi::where('nama', '=', $row['prodi'])->first();
        // dd($row);

        $formattedDate = Carbon::createFromFormat('d/m/Y', $row['tgl_masuk'])->format('Y-m-d');

        $ipk = floatval($row['ipk']);
        if ($ipk <= 0 || $ipk > 4) {
            // Pastikan IPK berada dalam rentang yang valid, misal antara 0 dan 4
            throw new \Exception('Nilai IPK harus dalam rentang 0 - 4.');
        }

        // Assuming the Excel file has columns like NPM, Nama Mahasiswa, IPK, JML SKS, etc.
        return new Detail([
            'id_yudisium' => $this->yudisium_id,
            'id_pt' => $yudisium->id_pt,
            'id_batch' => $yudisium->id_batch,
            'id_prodi' => $prodi->id,
            'npm' => $row['npm'],  // Assuming column 0 contains the NPM
            'nama_mhs' => $row['nama_mhs'],  // Assuming column 1 contains the Name
            'ipk' => $ipk,  // Assuming column 2 contains the IPK
            'jml_sks' => $row['jml_sks'],  // Assuming column 3 contains the SKS count
            'tgl_masuk' => $formattedDate,
            'tgl_lulus' => $formattedDate,
            'jk' => $row['jk'],
        ]);
    }
}
