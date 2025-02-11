<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

    public function create()
    {
        $statuses = Cache::remember('statuses', 3600, fn() => PackageStatus::all());
        $deliveryTypes = Cache::remember('deliveryTypes', 3600, fn() => DeliveryType::all());

        return view('packages.create', compact('statuses', 'deliveryTypes'));
    }

    public function store(Request $request)
    {

        $attrs = $request->validate([
            'store_id' => ['required', Rule::exists(Store::class, 'id')->where('status', true)],
            'delivery_type_id' => ['required', Rule::exists(DeliveryType::class, 'id')],
            'name' => ['nullable', 'string', 'max:255'],
            'client_first_name' => ['required', 'string', 'max:255'],
            'client_last_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:255'],
            'client_phone2' => ['nullable', 'string', 'max:255'],
            'commune_id' => ['required', Rule::exists(Commune::class, 'id')],
            'address' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'delivery_price' => ['required', 'numeric', 'min:0'],
            'packaging_price' => ['required', 'numeric', 'min:0'],
            'partner_cod_price' => ['required', 'numeric', 'min:0'],
            'partner_delivery_price' => ['required', 'numeric', 'min:0'],
            'return_price' => ['required', 'numeric', 'min:0'],
            'partner_return' => ['required', 'numeric', 'min:0'],
            'cod_to_pay' => ['required', 'numeric', 'min:0'],
            'commission' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'extra_weight_price' => ['required', 'numeric', 'min:0'],
            'free_delivery' => ['required', 'boolean'],
            'can_be_opened' => ['required', 'boolean'],
        ]);

        $attrs['uuid'] = Str::uuid()->toString();
        $attrs['tracking_code'] = 'zm-'.Str::random(6);
        $attrs['status_id'] = PackageStatus::first()->id; // Get the default or pending status


        $attrs['total_price'] = 2000; // Calculate the price depending on business logic
        $attrs['price_to_pay'] = 20000; // Calculate the price depending on business logic

        Package::create($attrs);

        return redirect()->route('packages.index');
    }
}
