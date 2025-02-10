<?php

namespace App\Jobs;

use App\Models\Package;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        $path = storage_path('app/exports/packages/' . $this->filename);
        $headers = [
            'Tracking Code', 'Store', 'Package name', 'Status',
            'Client', 'Phone', 'Wilaya', 'Commune', 'Delivery Type',
        ];
        $writer = SimpleExcelWriter::create($path)->addHeader($headers);

        Package::query()->select(
            'id', 'name', 'client_first_name', 'client_last_name',
            'store_id', 'commune_id', 'delivery_type_id', 'status_id',
            'tracking_code', 'client_phone'
        )->with(
            [
                'store:id,name,status', 'commune', 'commune.wilaya', 'deliveryType', 'status',
            ]
        )->cursor()->each(function ($package) use ($writer) {
            $writer->addRow([
                $package->tracking_code,
                $package->store->name,
                $package->name,
                $package->status->name,
                $package->client_last_name.' '.$package->client_first_name,
                $package->client_phone,
                $package->commune->wilaya->name,
                $package->commune->name,
                $package->deliveryType->name,
            ]);
        });

        $writer->close();


    }
}
