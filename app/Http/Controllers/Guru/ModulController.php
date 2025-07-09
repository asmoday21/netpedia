<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModulController extends Controller
{
public function index(Request $request)
{
    $query = Modul::query();

    // Jika ingin filter modul hanya milik guru:
    // $query->where('guru_id', auth()->id());

    // Jika ada pencarian
    if ($request->has('search') && $request->search != '') {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    // Ambil data terurut dan paginate
    $moduls = $query->latest()->paginate(9);

    // Jika request dari AJAX (misal live search)
    if ($request->ajax()) {
        return view('guru.modul._list', compact('moduls'))->render();
    }

    return view('guru.modul.index', compact('moduls'));
}

    public function create()
    {
        return view('guru.modul.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:5120',
            'embed_link' => 'nullable|url',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('modul_images', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('modul_pdfs', 'public');
        }

        // Jika ada, tambahkan guru_id misal untuk filtering (sesuaikan jika kamu punya relasi)
        // $validated['guru_id'] = auth()->id();

        Modul::create($validated);

        return redirect()->route('guru.modul.index')->with('success', 'Modul berhasil dibuat.');
    }

    public function show(Modul $modul)
    {
        return view('guru.modul.show', compact('modul'));
    }

    public function edit(Modul $modul)
    {
        return view('guru.modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:5120',
            'embed_link' => 'nullable|url',
        ]);

        if ($request->hasFile('gambar')) {
            if ($modul->gambar) {
                Storage::disk('public')->delete($modul->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('modul_images', 'public');
        } else {
            $validated['gambar'] = $modul->gambar;
        }

        if ($request->hasFile('file_pdf')) {
            if ($modul->file_pdf) {
                Storage::disk('public')->delete($modul->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('modul_pdfs', 'public');
        } else {
            $validated['file_pdf'] = $modul->file_pdf;
        }

        $modul->update($validated);

        return redirect()->route('guru.modul.show', $modul->id)->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(Modul $modul)
    {
        if ($modul->gambar) {
            Storage::disk('public')->delete($modul->gambar);
        }
        if ($modul->file_pdf) {
            Storage::disk('public')->delete($modul->file_pdf);
        }

        $modul->delete();

        return redirect()->route('guru.modul.index')->with('success', 'Modul berhasil dihapus.');
    }

        public function upload3d(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'model3d' => 'required|file|mimes:glb,gltf|max:20480', // max 20MB
        ]);

        // Simpan file model 3d ke storage/app/public/modul_3d
        $file = $request->file('model3d');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/modul_3d', $filename);

        // Simpan data modul ke DB
        $modul = new Modul();
        $modul->judul = $request->judul;
        $modul->tipe_konten = '3d';
        $modul->konten = 'modul_3d/' . $filename;  // simpan path relatif tanpa 'public/'
        $modul->save();

        return redirect()->route('guru.modul.index')->with('success', 'Model 3D berhasil diupload.');
    }
}
