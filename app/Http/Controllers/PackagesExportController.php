<?php

namespace App\Http\Controllers;

use App\Jobs\PackagesExport;
use Illuminate\Support\Str;

class PackagesExportController extends Controller
{
    public function __invoke()
    {
        $filename = sprintf('%s_%s_%s.csv', 'packages', now()->format('Y-m-d-His'), Str::random(8));

        PackagesExport::dispatch(auth()->user(), $filename);

        return redirect()->route('packages.index')->with('status', "The package export process has started. We’ll notify you once it's complete.");
    }
}
