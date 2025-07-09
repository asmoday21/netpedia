<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\User;
use App\Models\Nilai;
use Illuminate\Support\Facades\Log;

class NilaiImportController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with('user')
            ->where('guru_id', auth()->id())
            ->latest()
            ->get();

        return view('guru.nilai.index', compact('nilai'));
    }

    public function form()
    {
        return view('guru.nilai.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            if (count($sheet) < 2) {
                return redirect()->back()->with('error', 'File Excel kosong atau tidak memiliki data.');
            }

            // Baca header
            $header = array_map(fn($h) => strtolower(trim($h)), $sheet[0]);

            $nisIndex = null;
            $nilaiIndex = null;
            $namaIndex = null;

            foreach ($header as $i => $col) {
                if (str_contains($col, 'nis')) $nisIndex = $i;
                if (str_contains($col, 'nilai') || str_contains($col, 'skor') || str_contains($col, 'score')) $nilaiIndex = $i;
                if (str_contains($col, 'nama')) $namaIndex = $i;
            }

            if (is_null($nisIndex) || is_null($nilaiIndex)) {
                return redirect()->back()->with('error', 'Kolom "nis" atau "nilai" tidak ditemukan di header file.');
            }

            $importedCount = 0;
            $notFoundNIS = [];
            $nameMismatch = [];

            foreach ($sheet as $rowIndex => $row) {
                if ($rowIndex === 0) continue;

                $nis = isset($row[$nisIndex]) ? trim((string)$row[$nisIndex]) : null;
                $nilaiRaw = isset($row[$nilaiIndex]) ? trim((string)$row[$nilaiIndex]) : null;
                $namaExcel = isset($row[$namaIndex]) ? strtolower(trim($row[$namaIndex])) : null;
                $keterangan = $request->input('keterangan', 'Nilai diunggah melalui file Excel');

                if (!$nis || !$nilaiRaw) continue;

                // Ambil angka dari format "80 / 100"
                if (strpos($nilaiRaw, '/') !== false) {
                    $nilaiAngka = trim(explode('/', $nilaiRaw)[0]);
                } else {
                    $nilaiAngka = $nilaiRaw;
                }

                // Validasi nilai angka
                if (!is_numeric($nilaiAngka)) continue;

                $user = User::whereRaw('TRIM(nis) = ?', [$nis])->first();

                if ($user) {
                    // Validasi nama jika tersedia
                    if (!is_null($namaIndex)) {
                        $namaDb = strtolower(trim($user->name));
                        if ($namaDb !== $namaExcel) {
                            $nameMismatch[] = "NIS $nis (Excel: $namaExcel ≠ DB: $namaDb)";
                            continue;
                        }
                    }

                    Nilai::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'keterangan' => $keterangan,
                        ],
                        [
                            'guru_id' => auth()->id(),
                            'nilai_angka' => $nilaiAngka, // ✅ konsisten
                            'link_eksternal' => $request->input('link', null),
                        ]
                    );

                    $importedCount++;
                } else {
                    $notFoundNIS[] = $nis;
                }
            }

            $message = "{$importedCount} nilai berhasil diimpor.";
            if ($notFoundNIS) {
                $message .= " NIS tidak ditemukan: " . implode(', ', array_unique($notFoundNIS)) . ".";
            }
            if ($nameMismatch) {
                $message .= " Nama tidak cocok: " . implode('; ', $nameMismatch);
            }

            return redirect()->route('guru.nilai.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Gagal impor nilai: ' . $e->getMessage());
            return redirect()->route('guru.nilai.index')
                ->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);

        if ($nilai->guru_id !== auth()->id()) {
            abort(403);
        }

        $nilai->delete();

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
