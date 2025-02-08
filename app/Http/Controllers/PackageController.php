<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        $packages = Package::query()->select(
            'id', 'name', 'client_first_name', 'client_last_name',
            'store_id', 'commune_id', 'delivery_type_id', 'status_id',
            'tracking_code', 'client_phone'
        )->with(
            [
                'store:id,name,status', 'commune', 'commune.wilaya', 'deliveryType', 'status',
            ]
        )->cursorPaginate(10);

        return view('packages.index', compact('packages'));
    }
}
