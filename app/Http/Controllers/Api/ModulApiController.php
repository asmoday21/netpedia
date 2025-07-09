<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Import Validator

class ModulApiController extends Controller
{
    /**
     * Display a listing of the modules.
     * Supports search, category filter, and pagination.
     */
    public function index(Request $request)
    {
        $query = Modul::latest();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('konten', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kategori', 'like', '%' . $searchTerm . '%')
                  ->orWhere('youtube_title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== '') {
            $query->where('kategori', $request->category);
        }

        // Pagination
        $moduls = $query->paginate($request->get('per_page', 10)); // Default 10 items per page

        return response()->json($moduls);
    }

    /**
     * Store a newly created module in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Handle file uploads (gambar and file_pdf)
        $validated = $this->handleFileUploads($request, $validated);

        // Extract YouTube thumbnail if embed_link is provided
        if (!empty($validated['embed_link'])) {
            $validated['youtube_thumbnail'] = $this->extractYoutubeThumbnail($validated['embed_link']);
        }

        $modul = Modul::create($validated);
        return response()->json($modul, 201); // 201 Created status code
    }

    /**
     * Display the specified module.
     */
    public function show(Modul $modul)
    {
        // Optionally generate embed URL for the client if needed
        // $modul->youtube_embed_url = $this->generateYoutubeEmbedUrl($modul->embed_link);
        return response()->json($modul);
    }

    /**
     * Update the specified module in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules(true)); // Pass true for update rules

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Handle file uploads (gambar and file_pdf) for update
        $validated = $this->handleFileUploads($request, $validated, $modul);

        // Handle removal of existing PDF if requested
        if ($request->boolean('remove_file_pdf')) { // Use boolean() helper
            if ($modul->file_pdf) {
                Storage::disk('public')->delete($modul->file_pdf);
            }
            $validated['file_pdf'] = null; // Set to null in DB
        }
        // Handle removal of existing image if requested (optional, add this if you need it)
        // if ($request->boolean('remove_gambar')) {
        //     if ($modul->gambar) {
        //         Storage::disk('public')->delete($modul->gambar);
        //     }
        //     $validated['gambar'] = null;
        // }


        // Extract YouTube thumbnail if embed_link is provided
        if (!empty($validated['embed_link'])) {
            $validated['youtube_thumbnail'] = $this->extractYoutubeThumbnail($validated['embed_link']);
        } else {
            // If embed_link is cleared, also clear youtube_thumbnail and youtube_title
            $validated['youtube_thumbnail'] = null;
            $validated['youtube_title'] = null;
        }

        $modul->update($validated);
        return response()->json($modul);
    }

    /**
     * Remove the specified module from storage.
     */
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
        return response()->json(null, 204); // 204 No Content status code
    }

    /** ========== Helper Methods (Moved from Admin ModulController) ========== */

    /**
     * Get the validation rules for Modul.
     * @param bool $isUpdate Whether it's an update operation (e.g., for file rules)
     * @return array
     */
    private function getValidationRules(bool $isUpdate = false): array
    {
        // In update, 'gambar' and 'file_pdf' are not always required to be present again
        $imageRule = $isUpdate ? 'nullable|image|max:2048' : 'nullable|image|max:2048';
        $pdfRule = $isUpdate ? 'nullable|mimes:pdf|max:5120' : 'nullable|mimes:pdf|max:5120';

        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'embed_link' => 'nullable|url',
            'kategori' => 'nullable|string|max:100',
            'gambar' => $imageRule,
            'file_pdf' => $pdfRule,
            'youtube_title' => 'nullable|string|max:255',
            // Add 'remove_file_pdf' rule for API to indicate removal
            'remove_file_pdf' => 'boolean',
            // 'remove_gambar' => 'boolean', // If you implement remove image feature
        ];
    }

    /**
     * Handles file uploads (gambar and file_pdf).
     * @param Request $request
     * @param array $validated
     * @param Modul|null $modul
     * @return array
     */
    private function handleFileUploads(Request $request, array $validated, ?Modul $modul = null): array
    {
        // Handle 'gambar' (image) upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists during update
            if ($modul && $modul->gambar) {
                Storage::disk('public')->delete($modul->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('modul_images', 'public');
        } elseif ($modul && !$request->boolean('remove_gambar')) { // If not uploading new and not explicitly removing
            $validated['gambar'] = $modul->gambar; // Keep existing image path
        } else {
            $validated['gambar'] = null; // No image, or explicitly removed
        }


        // Handle 'file_pdf' upload
        if ($request->hasFile('file_pdf')) {
            // Delete old PDF if exists during update
            if ($modul && $modul->file_pdf) {
                Storage::disk('public')->delete($modul->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('modul_pdfs', 'public');
        } elseif ($modul && !$request->boolean('remove_file_pdf')) { // If not uploading new and not explicitly removing
            $validated['file_pdf'] = $modul->file_pdf; // Keep existing PDF path
        } else {
            $validated['file_pdf'] = null; // No PDF, or explicitly removed
        }

        return $validated;
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
}
