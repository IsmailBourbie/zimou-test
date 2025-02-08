@component('layouts.base', ['title' => 'Packages'])
    <div class="container mx-auto mt-10 space-y-8">
        <h2 class="text-2xl">ALl Packages</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Tracking Code</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Store</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Store Status</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Client</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Wilaya</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Commune</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Delivery Type</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Package Status</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @foreach($packages as $package)
                    <tr class="odd:bg-gray-50">
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">{{$package->tracking_code}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->store->name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->store->status}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->client_first_name . ' '. $package->client_last_name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->client_phone}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->commune->wilaya->name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->commune->name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->deliveryType->name}}</td>
                        <td class="whitespace-nowrap p-4 text-gray-700">{{$package->status->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4">
            {{ $packages->links('pagination::tailwind') }}
        </div>
    </div>
@endcomponent
