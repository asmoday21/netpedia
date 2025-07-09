<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class GuruMateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $materi = $query->latest()->paginate(10);

        return view('guru.materi.index', compact('materi'));
    }

    public function create()
    {
        return view('guru.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10 MB
        ]);

        $materi = new Materi();
        $materi->judul = $request->judul;
        $materi->konten = $request->konten;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('materi', $filename, 'public');
            $materi->file = $path;
        }

        $materi->save();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('guru.materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $materi = Materi::findOrFail($id);
        $materi->judul = $request->judul;
        $materi->konten = $request->konten;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($materi->file) {
                Storage::delete('public/' . $materi->file);
            }

            $filename = 'materi/' . time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('public/materi', basename($filename));
            $materi->file = $filename;
        }

        $materi->save();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->file) {
            Storage::delete('public/' . $materi->file);
        }

        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('guru.materi.show', compact('materi'));
    }
    
    public function showTcpIp()
    { 
        return view('guru.materi.tcp_ip'); 
    }
    public function showLayananJaringan() 
    { 
        return view('guru.materi.layanan_jaringan'); 
    }
    public function showKeamananJaringan() 
    { 
        return view('guru.materi.keamanan_jaringan'); 
    }

}
