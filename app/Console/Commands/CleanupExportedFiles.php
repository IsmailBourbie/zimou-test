<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupExportedFiles extends Command
{
    protected $signature = 'exports:cleanup';
    protected $description = 'Delete export files older than 24 hours';

    public function handle(): void
    {
        $exportPath = storage_path('app/exports/packages/');
        $files = glob($exportPath.'/*');

        foreach ($files as $file) {
            if (filemtime($file) < now()->addHours(24)->timestamp) {
                unlink($file);
                $this->info("Deleted: $file");
            }
        }

        $this->info('Cleanup completed.');
    }
}
