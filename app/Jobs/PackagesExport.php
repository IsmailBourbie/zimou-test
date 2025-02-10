<?php

namespace App\Jobs;

use App\Models\Package;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelWriter;

class PackagesExport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly string $filename)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $start = memory_get_usage();
        $path = storage_path('app/exports/packages/'.$this->filename);
        $headers = [
            'Tracking Code', 'Store', 'Package name', 'Status',
            'Client', 'Phone', 'Wilaya', 'Commune', 'Delivery Type',
        ];
        $writer = SimpleExcelWriter::create($path)->addHeader($headers);

        DB::table('packages')
            ->join('stores', 'packages.store_id', '=', 'stores.id')
            ->join('communes', 'packages.commune_id', '=', 'communes.id')
            ->join('wilayas', 'communes.wilaya_id', '=', 'wilayas.id')
            ->join('delivery_types', 'packages.delivery_type_id', '=', 'delivery_types.id')
            ->join('package_statuses', 'packages.status_id', '=', 'package_statuses.id')
            ->select(
                'packages.id',
                'packages.name',
                'packages.client_first_name',
                'packages.client_last_name',
                'packages.store_id',
                'packages.commune_id',
                'packages.delivery_type_id',
                'packages.status_id',
                'packages.tracking_code',
                'packages.client_phone',
                'stores.name as store',
                'communes.name as commune',
                'wilayas.name as wilaya',
                'delivery_types.name as delivery_type',
                'package_statuses.name as status'
            )->orderBy('id')->cursor()->each(function ($package) use ($writer) {
                $writer->addRow([
                    $package->tracking_code,
                    $package->store,
                    $package->name,
                    $package->status,
                    $package->client_last_name.' '.$package->client_first_name,
                    $package->client_phone,
                    $package->wilaya,
                    $package->commune,
                    $package->delivery_type,
                ]);
            });
        $end = memory_get_usage();

        Log::info('memory: '. $end - $start);

        $writer->close();


    }
}
