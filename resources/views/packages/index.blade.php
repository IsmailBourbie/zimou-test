@component('layouts.base', ['title' => 'Packages'])
    <div class="container mx-auto mt-10 space-y-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl">ALl Packages</h2>
            <div>
            <a href="{{route('packages.create')}}" class="px-3 py-1.5 border border-slate-700 bg-slate-600 hover:bg-slate-700 text-white rounded-lg">Create Package</a>
            <a href="{{route('packages.export')}}" class="px-3 py-1.5 border border-blue-700 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Export Packages</a>

            </div>
        </div>

        @if(session('status'))
            <div class="bg-green-100 w-6/12 mx-auto border border-green-300 text-green-700 font-medium tracking-wide px-4 py-3 rounded text-center mt-5">
                {{session('status')}}
            </div>
        @endif
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
            {{ $packages->links() }}
        </div>
    </div>
@endcomponent
