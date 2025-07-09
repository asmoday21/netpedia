<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('ckeditor', 'public');

            $url = asset('storage/' . $path);

            return response()->json([
                'url' => $url,
            ]);
        }

        return response()->json(['error' => 'Gagal upload file'], 400);
    }
}

