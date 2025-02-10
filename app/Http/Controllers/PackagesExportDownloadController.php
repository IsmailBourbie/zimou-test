<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackagesExportDownloadController extends Controller
{
    public function __invoke(Request $request, $filename)
    {
        $filePath = storage_path('app/exports/packages/'.$filename);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath);
    }
}
