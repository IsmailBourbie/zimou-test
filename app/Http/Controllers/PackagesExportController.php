<?php

namespace App\Http\Controllers;

use App\Jobs\PackagesExport;

class PackagesExportController extends Controller
{
    public function __invoke()
    {
        PackagesExport::dispatch();
    }
}
