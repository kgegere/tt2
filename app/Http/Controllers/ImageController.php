<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function show($path)
    {
        $path = request()->route('path');

        if (!Storage::disk('public')->exists($path)) {
            $path = 'fallback.png';
            if (!Storage::disk('public')->exists($path)) {
                \Log::info('Not found. Returning 404');
                abort(404, 'Fallback image not found.');
            }
        } else {
            \Log::info('Image found at: ' . $path);
        }

        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }
}
