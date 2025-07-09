<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    // Menampilkan semua modul
    public function index()
    {
        $moduls = Modul::all();
        return view('admin.modul.index', compact('moduls'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('admin.modul.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:10240', // Perbaiki nama input
            'qr_code' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $modul = new Modul();
        $modul->judul = $request->judul;
        $modul->deskripsi = $request->deskripsi;
        $modul->konten = $request->konten;

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/gambar_modul'), $imageName);
            $modul->gambar = $imageName;
        }

        // Simpan PDF jika ada
        if ($request->hasFile('file_pdf')) {
            $pdf = $request->file('file_pdf');
            $pdfName = time().'_'.$pdf->getClientOriginalName();
            $pdf->move(public_path('uploads/pdf_modul'), $pdfName);
            $modul->file_pdf = $pdfName;
        }

        // Simpan QR code jika ada
        if ($request->hasFile('qr_code')) {
            $qrPath = $request->file('qr_code')->store('moduls/qr_codes', 'public');
            $modul->qr_code = $qrPath;
        }

        $modul->save();

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil ditambahkan.');
    }

    // Tampilkan detail modul
    public function show($id)
    {
        $modul = Modul::findOrFail($id);
        return view('admin.modul.show', compact('modul'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $modul = Modul::findOrFail($id);
        return view('admin.modul.edit', compact('modul'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'qr_code' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $modul->judul = $request->judul;
        $modul->deskripsi = $request->deskripsi;
        $modul->konten = $request->konten;

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($modul->gambar && file_exists(public_path('uploads/gambar_modul/'.$modul->gambar))) {
                unlink(public_path('uploads/gambar_modul/'.$modul->gambar));
            }
            $image = $request->file('gambar');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/gambar_modul'), $imageName);
            $modul->gambar = $imageName;
        }

        // Update PDF jika ada
        if ($request->hasFile('file_pdf')) {
            // Hapus file PDF lama jika ada
            if ($modul->file_pdf && file_exists(public_path('uploads/pdf_modul/'.$modul->file_pdf))) {
                unlink(public_path('uploads/pdf_modul/'.$modul->file_pdf));
            }
            $pdf = $request->file('file_pdf');
            $pdfName = time().'_'.$pdf->getClientOriginalName();
            $pdf->move(public_path('uploads/pdf_modul'), $pdfName);
            $modul->file_pdf = $pdfName;
        }

        // Update QR code jika ada
        if ($request->hasFile('qr_code')) {
            // Hapus QR code lama jika ada
            if ($modul->qr_code && Storage::exists('public/'.$modul->qr_code)) {
                Storage::delete('public/'.$modul->qr_code);
            }
            $qrPath = $request->file('qr_code')->store('moduls/qr_codes', 'public');
            $modul->qr_code = $qrPath;
        }

        $modul->save();

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil diperbarui.');
    }

    // Hapus modul
    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus gambar, PDF, dan QR code jika ada
        if ($modul->gambar && file_exists(public_path('uploads/gambar_modul/'.$modul->gambar))) {
            unlink(public_path('uploads/gambar_modul/'.$modul->gambar));
        }

        if ($modul->file_pdf && file_exists(public_path('uploads/pdf_modul/'.$modul->file_pdf))) {
            unlink(public_path('uploads/pdf_modul/'.$modul->file_pdf));
        }

        if ($modul->qr_code && Storage::exists('public/'.$modul->qr_code)) {
            Storage::delete('public/'.$modul->qr_code);
        }

        $modul->delete();

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil dihapus!');
    }
}
