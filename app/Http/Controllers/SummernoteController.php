<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SummernoteController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('summernote', 'public');
            return asset('storage/' . $path);
        }

        return response()->json(['error' => 'Gagal upload'], 400);
    }
}

