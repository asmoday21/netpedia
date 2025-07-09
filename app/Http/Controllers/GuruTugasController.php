<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class GuruTugasController extends Controller
{
    /**
     * Menampilkan daftar tugas untuk guru.
     */
    public function index()
    {
        $tugas = Tugas::where('guru_id', auth()->id())
                      ->latest()
                      ->paginate(10);

        $allTugas = Tugas::where('guru_id', auth()->id())->get();

        $aktiveTugas = $allTugas->filter(function($item) {
            return !Carbon::parse($item->batas_pengumpulan)->isPast();
        })->count();

        $kedaluwarsaTugas = $allTugas->filter(function($item) {
            return Carbon::parse($item->batas_pengumpulan)->isPast();
        })->count();

        // Mengubah logika untuk hanya menghitung tugas dengan link_tugas
        $tugasWithLinks = $allTugas->filter(function($item) {
            return !empty($item->link_tugas);
        })->count();

        return view('guru.tugas.index', compact('tugas', 'aktiveTugas', 'kedaluwarsaTugas', 'tugasWithLinks'));
    }

    /**
     * Menampilkan form untuk membuat tugas baru.
     */
    public function create()
    {
        return view('guru.tugas.create');
    }

    /**
     * Menyimpan tugas baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input: Hanya link_tugas yang diperbolehkan
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_pengumpulan' => 'required|date|after_or_equal:now',
            'link_tugas' => 'required|url|max:2048', // link_tugas menjadi required
        ]);

        // Inisialisasi data untuk disimpan
        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'batas_pengumpulan' => $validated['batas_pengumpulan'],
            'guru_id' => auth()->id(),
            'lampiran' => null, // Pastikan lampiran selalu null
            'original_filename' => null, // Pastikan original_filename selalu null
            'link_tugas' => $validated['link_tugas'],
        ];

        // Simpan data tugas ke database
        Tugas::create($data);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk mengedit tugas yang sudah ada.
     */
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->batas_pengumpulan = Carbon::parse($tugas->batas_pengumpulan)->format('Y-m-d\TH:i');

        return view('guru.tugas.edit', compact('tugas'));
    }

    /**
     * Memperbarui tugas yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        // Validasi input: Hanya link_tugas yang diperbolehkan
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_pengumpulan' => 'required|date|after_or_equal:now',
            'link_tugas' => 'required|url|max:2048', // link_tugas menjadi required
            'hapus_link_tugas' => 'nullable|boolean', // Tetap ada untuk opsi penghapusan link
        ]);

        // Update data dasar tugas
        $tugas->judul = $validated['judul'];
        $tugas->deskripsi = $validated['deskripsi'] ?? null;
        $tugas->batas_pengumpulan = $validated['batas_pengumpulan'];

        // Logika Update Link Tugas
        // Pastikan lampiran dan original_filename selalu null saat update
        $tugas->lampiran = null;
        $tugas->original_filename = null;

        if ($request->boolean('hapus_link_tugas')) {
            $tugas->link_tugas = null;
        } else {
            $tugas->link_tugas = $validated['link_tugas'];
        }

        $tugas->save();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Menghapus tugas dari database.
     */
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Hapus juga semua pengumpulan tugas yang terkait
        $pengumpulanTugas = PengumpulanTugas::where('tugas_id', $tugas->id)->get();
        foreach ($pengumpulanTugas as $jawaban) {
            // Logika penghapusan file_jawaban (dari siswa) tetap dipertahankan
            $filesData = $jawaban->file_jawaban; // Sudah di-cast ke array oleh model
            if (is_array($filesData)) {
                foreach ($filesData as $fileData) {
                    if (isset($fileData['path']) && Storage::disk('public')->exists($fileData['path'])) {
                        Storage::disk('public')->delete($fileData['path']);
                    }
                }
            }
            $jawaban->delete(); // Hapus record pengumpulan tugas
        }

        // Tidak ada lagi penghapusan lampiran tugas dari guru karena sudah dihapus fiturnya
        // Pastikan kolom 'lampiran' dan 'original_filename' di database bisa null

        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Menampilkan daftar jawaban tugas dari siswa untuk tugas tertentu.
     */
    public function jawaban($id)
    {
        $tugas = Tugas::findOrFail($id);

        $jawaban = PengumpulanTugas::where('tugas_id', $id)
                                   ->with(['siswa', 'siswa.kelas'])
                                   ->orderBy('waktu_kumpul', 'desc')
                                   ->paginate(10);

        return view('guru.tugas.jawaban', compact('tugas', 'jawaban'));
    }

    /**
     * Memberikan nilai dan catatan pada jawaban siswa.
     */
    public function berinilai(Request $request, $jawabanId)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:500',
        ]);

        $jawaban = PengumpulanTugas::findOrFail($jawabanId);

        $jawaban->update([
            'nilai' => $request->nilai,
            'catatan_guru' => $request->catatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nilai dan catatan berhasil disimpan.',
            'nilai' => $jawaban->nilai,
            'catatan' => $jawaban->catatan_guru
        ]);
    }

    /**
     * Digunakan untuk filtering data tugas secara AJAX (tampilan grid seperti Trello).
     */
    public function filter(Request $request)
    {
        $query = Tugas::where('guru_id', auth()->id());

        $tugas = $query->latest()->get();

        return response()->json([
            'html' => view('guru.tugas.partials.tugas_grid', compact('tugas'))->render()
        ]);
    }

    /**
     * Metode untuk memfilter jawaban tugas berdasarkan keyword dan status.
     */
    public function filterJawaban(Request $request, $tugas_id)
    {
        $keyword = $request->query('search', '');
        $status = $request->query('status', 'all');

        $query = PengumpulanTugas::with('siswa')->where('tugas_id', $tugas_id);

        if ($keyword) {
            $query->whereHas('siswa', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        }

        if ($status == 'sudah') {
            $query->whereNotNull('nilai');
        } elseif ($status == 'belum') {
            $query->whereNull('nilai');
        }

        $jawaban = $query->orderBy('waktu_kumpul', 'desc')->get();

        return response()->json([
            'jawaban' => $jawaban,
        ]);
    }

    /**
     * Menampilkan daftar nilai tugas untuk guru.
     */
    public function indexNilai()
    {
        $nilai = PengumpulanTugas::with(['siswa', 'tugas'])
            ->whereHas('tugas', function($q) {
                $q->where('guru_id', auth()->id());
            })
            ->whereNotNull('nilai')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('guru.nilai.index', compact('nilai'));
    }

    /**
     * Menampilkan nilai tugas untuk siswa (jika siswa melihat nilainya sendiri).
     * Catatan: Metode ini idealnya berada di SiswaTugasController atau SiswaNilaiController.
     * Dibiarkan di sini untuk sementara mengikuti struktur yang diberikan, tetapi disarankan untuk direfaktor.
     */
    public function nilaiSiswa()
    {
        $jawaban = PengumpulanTugas::with('tugas')
            ->where('siswa_id', auth()->id())
            ->orderBy('waktu_kumpul', 'desc')
            ->get();

        return view('siswa.nilai.index', compact('jawaban'));
    }
}