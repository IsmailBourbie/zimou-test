<?php

use App\Console\Commands\CleanupExportedFiles;


Schedule::command(CleanupExportedFiles::class)->daily();
