<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema; // PASTIKAN BARIS INI ADA!

class ModulController extends Controller
{
    /**
     * Display a listing of the modules.
     * Supports search, category filter, and pagination for AJAX requests.
     */
    public function index(Request $request)
    {
        $query = Modul::latest(); // Mulai query

        // Handle Search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kategori', 'like', '%' . $searchTerm . '%')
                  ->orWhere('youtube_title', 'like', '%' . $searchTerm . '%');
                // Tambahkan pencarian berdasarkan deskripsi jika kolom deskripsi ada di model Modul Anda
                if ($this->isColumnExists('moduls', 'deskripsi')) {
                    $q->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
                }
                if ($this->isColumnExists('moduls', 'konten')) {
                    $q->orWhere('konten', 'like', '%' . $searchTerm . '%');
                }
            });
        }

        // Handle Category Filter
        if ($request->filled('category') && $request->category !== '') {
            $query->where('kategori', $request->category);
        }

        $moduls = $query->paginate(10); // Lakukan paginasi

        // Statistik Cepat (tetap untuk semua modul, tidak terpengaruh filter)
        $totalModuls = Modul::count();
        $videoModuls = Modul::whereNotNull('embed_link')->count(); // Menggunakan embed_link
        $docModuls = $totalModuls - $videoModuls;
        
        // Ambil semua kategori unik dari modul yang ada
        $kategoris = Modul::select('kategori')
                            ->whereNotNull('kategori')
                            ->distinct()
                            ->pluck('kategori');
        
        // Jika request adalah AJAX, kembalikan hanya HTML untuk kartu modul dan pagination
        if ($request->ajax()) {
            $modulHtml = view('admin.modul.partials.modul_cards', compact('moduls'))->render();
            $paginationHtml = $moduls->links('vendor.pagination.bootstrap-5')->render();

            return response()->json([
                'html' => $modulHtml,
                'pagination' => $paginationHtml
            ]);
        }

        // Jika bukan AJAX, tampilkan view lengkap
        return view('admin.modul.index', compact(
            'moduls', 
            'totalModuls',
            'videoModuls',
            'docModuls',
            'kategoris'
        ));
    }

    public function create()
    {
        return view('admin.modul.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateModul($request);

        // Handle file uploads (gambar and file_pdf)
        $validated = $this->handleFileUploads($request, $validated);

        // Extract YouTube thumbnail if embed_link is provided
        if (!empty($validated['embed_link'])) {
            $validated['youtube_thumbnail'] = $this->extractYoutubeThumbnail($validated['embed_link']);
        } else {
            // Jika embed_link kosong, pastikan thumbnail dan title juga kosong
            $validated['youtube_thumbnail'] = null;
            $validated['youtube_title'] = null;
        }

        Modul::create($validated);

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil dibuat.');
    }

    public function show(Modul $modul)
    {
        // youtubeEmbedUrl sudah tidak diperlukan karena halaman show sekarang menggunakan embed_link langsung
        // $youtubeEmbedUrl = $this->generateYoutubeEmbedUrl($modul->embed_link);
        return view('admin.modul.show', compact('modul'));
    }

    public function edit(Modul $modul)
    {
        return view('admin.modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        $validated = $this->validateModul($request);

        // Handle file removal if requested (from the 'edit' page)
        if ($request->boolean('remove_file_pdf')) {
            if ($modul->file_pdf) {
                Storage::disk('public')->delete($modul->file_pdf);
            }
            $validated['file_pdf'] = null; // Set to null in DB
        }
        // Jika ada fitur untuk menghapus gambar yang sudah ada
        if ($request->boolean('remove_gambar')) {
            if ($modul->gambar) {
                Storage::disk('public')->delete($modul->gambar);
            }
            $validated['gambar'] = null;
        }

        // Handle file uploads (gambar and file_pdf)
        // Pastikan $modul dilewatkan agar handleFileUploads bisa menghapus file lama
        $validated = $this->handleFileUploads($request, $validated, $modul);

        // Extract YouTube thumbnail if embed_link is provided
        if (!empty($validated['embed_link'])) {
            $validated['youtube_thumbnail'] = $this->extractYoutubeThumbnail($validated['embed_link']);
        } else {
            // If embed_link is cleared, also clear youtube_thumbnail and youtube_title
            $validated['youtube_thumbnail'] = null;
            $validated['youtube_title'] = null;
        }

        $modul->update($validated);

        return redirect()->route('admin.modul.show', $modul->id)->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(Modul $modul)
    {
        // Delete associated files from storage
        if ($modul->gambar) {
            Storage::disk('public')->delete($modul->gambar);
        }

        if ($modul->file_pdf) {
            Storage::disk('public')->delete($modul->file_pdf);
        }

        $modul->delete();

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil dihapus.');
    }

    /** ========== Helper Methods ========== */

    /**
     * Get the validation rules for Modul.
     * @param bool $isUpdate Whether it's an update operation (e.g., for file rules)
     * @return array
     */
    private function validateModul(Request $request): array
    {
        // Default rules
        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string', // Ditambahkan validasi deskripsi
            'konten' => 'nullable|string',
            'embed_link' => 'nullable|url',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|max:2048', // Nullable karena opsional/bisa dihapus
            'file_pdf' => 'nullable|mimes:pdf|max:5120', // Nullable karena opsional/bisa dihapus
            'youtube_title' => 'nullable|string|max:255',
        ];

        // Tambahkan aturan khusus untuk penghapusan file jika ada
        if ($request->has('remove_file_pdf')) {
            $rules['remove_file_pdf'] = 'boolean';
        }
        if ($request->has('remove_gambar')) {
            $rules['remove_gambar'] = 'boolean';
        }

        return $request->validate($rules);
    }

    /**
     * Handles file uploads (gambar and file_pdf).
     * @param Request $request
     * @param array $validatedData
     * @param Modul|null $modul
     * @return array
     */
    private function handleFileUploads(Request $request, array $validatedData, ?Modul $modul = null): array
    {
        // Handle 'gambar' (image) upload
        if ($request->hasFile('gambar')) {
            if ($modul && $modul->gambar) { // Delete old image during update
                Storage::disk('public')->delete($modul->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('modul_images', 'public');
        } elseif ($modul && !isset($validatedData['remove_gambar'])) { // Keep old image if not uploading new and not explicitly removed
            $validatedData['gambar'] = $modul->gambar;
        } else { // No new image and not keeping old, or explicitly removed
            $validatedData['gambar'] = null;
        }

        // Handle 'file_pdf' upload
        if ($request->hasFile('file_pdf')) {
            if ($modul && $modul->file_pdf) { // Delete old PDF during update
                Storage::disk('public')->delete($modul->file_pdf);
            }
            $validatedData['file_pdf'] = $request->file('file_pdf')->store('modul_pdfs', 'public');
        } elseif ($modul && !isset($validatedData['remove_file_pdf'])) { // Keep old PDF if not uploading new and not explicitly removed
            $validatedData['file_pdf'] = $modul->file_pdf;
        } else { // No new PDF and not keeping old, or explicitly removed
            $validatedData['file_pdf'] = null;
        }

        return $validatedData;
    }

    /**
     * Extracts YouTube video ID and generates thumbnail URL.
     * @param string $url
     * @return string|null
     */
    private function extractYoutubeThumbnail(string $url): ?string
    {
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]{11})/', $url, $matches);
        return isset($matches[1]) ? "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg" : null;
    }

    /**
     * Generates YouTube embed URL from a full URL.
     * @param string|null $url
     * @return string|null
     */
    private function generateYoutubeEmbedUrl(?string $url): ?string
    {
        if (!$url) return null;
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]{11})/', $url, $matches);
        return isset($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
    }

    /**
     * Helper to check if a column exists in a table.
     * This is useful for conditional queries based on schema.
     * @param string $table
     * @param string $column
     * @return bool
     */
    private function isColumnExists(string $table, string $column): bool
    {
        // Pastikan Anda telah mengimpor Schema di bagian atas file:
        // use Illuminate\Support\Facades\Schema;
        return Schema::hasColumn($table, $column);
    }
}
