<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function deb(): BinaryFileResponse
    {
        // Get the path to the file within the storage directory
        $filePath = Storage::path('public/chub');

        // Check if the file exists
        if (!Storage::exists('public/chub')) {
            abort(404);
        }

        // Return the file as a response
        return response()->file($filePath);
    }
}
