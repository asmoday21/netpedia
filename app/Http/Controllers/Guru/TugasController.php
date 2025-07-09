<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\TugasJawaban;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TugasController extends Controller
{
    /**
     * Menampilkan daftar tugas untuk guru.
     */
    public function index(Request $request)
    {
        $query = Tugas::with(['kelas'])->where('guru_id', auth()->id());

        if ($request->filled('elemen')) {
            $query->where('elemen', $request->elemen);
        }

        if ($request->filled('siswa_id')) {
            $query->whereHas('kelas.siswa', function ($q) use ($request) {
                $q->where('id', $request->siswa_id);
            });
        }

        $tugas = $query->orderBy('batas_pengumpulan', 'desc')->paginate(10);

        return view('guru.tugas.index', compact('tugas'));
    }

    /**
     * Menampilkan form untuk membuat tugas baru.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('guru.tugas.create', compact('kelas'));
    }

    /**
     * Menyimpan tugas baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_pengumpulan' => 'required|date|after_or_equal:now',
            'kelas_id' => 'required|exists:kelas,id',
            'link_tugas' => 'required|url|max:2048', // link_tugas is now required
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'batas_pengumpulan' => $validated['batas_pengumpulan'],
            'guru_id' => auth()->id(),
            'kelas_id' => $validated['kelas_id'],
            'lampiran' => null, // Explicitly set to null as files are no longer allowed
            'original_filename' => null, // Explicitly set to null
            'link_tugas' => $validated['link_tugas'],
        ];

        Tugas::create($data);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk mengedit tugas yang sudah ada.
     */
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $kelas = Kelas::all();
        $tugas->batas_pengumpulan = Carbon::parse($tugas->batas_pengumpulan)->format('Y-m-d\TH:i');

        return view('guru.tugas.edit', compact('tugas', 'kelas'));
    }

    /**
     * Memperbarui tugas yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_pengumpulan' => 'required|date|after_or_equal:now',
            'kelas_id' => 'required|exists:kelas,id',
            'link_tugas' => 'required|url|max:2048', // link_tugas is now required
            'hapus_link_tugas' => 'nullable|boolean', // Option to clear the link
        ]);

        $tugas->judul = $validated['judul'];
        $tugas->deskripsi = $validated['deskripsi'] ?? null;
        $tugas->batas_pengumpulan = $validated['batas_pengumpulan'];
        $tugas->kelas_id = $validated['kelas_id'];

        // Always set lampiran to null as files are not supported
        $tugas->lampiran = null;
        $tugas->original_filename = null;

        // Handle link_tugas update
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

        // No need to delete task attachments as they are no longer supported.
        // Ensure 'lampiran' and 'original_filename' columns in 'tugas' table are nullable.

        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Menampilkan daftar jawaban tugas dari siswa untuk tugas tertentu.
     */
    public function jawaban($id)
    {
        $tugas = Tugas::findOrFail($id);

        $jawaban = $tugas->jawabanTugas()->with('siswa')->paginate(10);

        return view('guru.tugas.jawaban', compact('tugas', 'jawaban'));
    }

    /**
     * Menampilkan semua pengumpulan tugas untuk guru (termasuk siswa yang belum kirim).
     */
    public function showPengumpulan($id)
    {
        $tugas = Tugas::with(['jawabanTugas.siswa'])->findOrFail($id);
        return view('guru.tugas.pengumpulan', compact('tugas'));
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

        $jawaban = TugasJawaban::findOrFail($jawabanId);

        $jawaban->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nilai dan catatan berhasil disimpan.',
            'nilai' => $jawaban->nilai,
            'catatan' => $jawaban->catatan
        ]);
    }

    /**
     * Digunakan untuk filtering data tugas secara AJAX (tampilan grid seperti Trello).
     */
    public function filter(Request $request)
    {
        $query = Tugas::with('kelas')->where('guru_id', auth()->id());

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('elemen')) {
            $query->where('elemen', $request->elemen);
        }

        $tugas = $query->latest()->get();

        return response()->json([
            'html' => view('guru.tugas.partials.tugas_grid', compact('tugas'))->render()
        ]);
    }

    /**
     * Menampilkan daftar nilai tugas untuk guru.
     */
    public function indexNilai()
    {
        $nilai = TugasJawaban::with(['siswa', 'tugas'])
            ->whereHas('tugas', function($q) {
                $q->where('guru_id', auth()->id());
            })
            ->whereNotNull('nilai')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('guru.nilai.index', compact('nilai'));
    }
}