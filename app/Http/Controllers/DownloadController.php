<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function deb(): BinaryFileResponse
    {
        // Get the path to the file within the storage directory
        $filePath = Storage::path('public/chub.1.0.0.linux-x64.deb');

        // Check if the file exists
        if (!Storage::exists('public/chub.1.0.0.linux-x64.deb')) {
            abort(404);
            dd("NotFound");
        }

        dd($filePath);

        // Return the file as a response
        return response()->file($filePath);
    }
}
