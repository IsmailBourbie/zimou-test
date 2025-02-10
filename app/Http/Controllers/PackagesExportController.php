<?php

namespace App\Http\Controllers;

use App\Jobs\PackagesExport;
use Illuminate\Support\Str;

class PackagesExportController extends Controller
{
    public function __invoke()
    {
        $filename = sprintf('%s_%s_%s.csv', 'packages', now()->format('Y-m-d-His'), Str::random(8));
        PackagesExport::dispatch($filename);
    }
}
