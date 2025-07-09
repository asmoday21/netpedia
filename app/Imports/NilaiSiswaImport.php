<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiSiswaImport implements ToCollection
{
    protected $guruId;

    public function __construct($guruId)
    {
        $this->guruId = $guruId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            $namaSiswa = trim($row[0]); // Kolom 1: Nama
            $nilai     = $row[1];       // Kolom 2: Nilai
            $keterangan= $row[2] ?? 'Nilai diunggah guru';

            // Cari user berdasarkan nama (pastikan nama di database sama dengan Excel)
            $siswa = User::where('name', 'like', '%' . $namaSiswa . '%')
                         ->where('role', 'siswa')
                         ->first();

            if ($siswa) {
                Nilai::create([
                    'user_id'    => $siswa->id,
                    'guru_id'    => $this->guruId,
                    'nilai'      => $nilai,
                    'keterangan' => $keterangan,
                ]);
            }
        }
    }
}
