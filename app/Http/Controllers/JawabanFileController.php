<?php

namespace App\Http\Controllers;

use App\Models\JawabanFile;
use Illuminate\Support\Facades\Storage;

class JawabanFileController extends Controller
{
    public function destroy($id)
    {
        $file = JawabanFile::findOrFail($id);

        // Hapus file fisik
        if (Storage::disk('public')->exists($file->filepath)) {
            Storage::disk('public')->delete($file->filepath);
        }

        $file->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
