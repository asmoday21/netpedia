<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function ckeditorUpload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // maks 2MB
        ]);

        $path = $request->file('upload')->store('ckeditor', 'public');
        $url = asset('storage/' . $path);

        return response()->json(['url' => $url]);
    }
    
}
