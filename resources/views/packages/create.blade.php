@component('layouts.base', ['title' => 'Packages'])
    <div class="container mx-auto mt-10 space-y-8 mb-24">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl">Create Package</h2>
        </div>
        <form action="{{route('packages.store')}}" method="POST">
            @csrf
            <div class="w-8/12 mx-auto space-y-8">
                <div class="space-y-8 border border-gray-300 rounded-lg p-4">
                    <h3 class="text-2xl font-bold pb-4">General Information</h3>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            <input type="text" name="store_id" value="{{old('store_id')}}" placeholder="Select a store"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </label>
                        @error('store_id')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            <input type="text" name="name" value="{{old('name')}}" placeholder="Package name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </label>
                        @error('name')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <div class="mb-6 grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="weight" value="{{old('weight')}}" placeholder="Weight"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('weight')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="mb-6 grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="extra_weight_price" value="{{old('extra_weight_price')}}"
                                       placeholder="Extra weight price"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('extra_weight_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-4 border border-gray-300 rounded-lg p-4">
                    <h3 class="text-2xl font-bold pb-4">Shipping Information</h3>
                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="client_first_name" value="{{old('client_first_name')}}"
                                       placeholder="First name*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('client_first_name')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="client_last_name" value="{{old('client_last_name')}}"
                                       placeholder="Last name*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('client_last_name')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="client_phone" value="{{old('client_phone')}}"
                                       placeholder="Phone*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('client_phone')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="client_phone2" value="{{old('client_phone2')}}"
                                       placeholder="Second phone*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('client_phone2')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" placeholder="Wilaya*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="commune_id" value="{{old('commune_id')}}"
                                       placeholder="Commune*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('commune_id')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            <input type="text" name="address" value="{{old('address')}}" placeholder="Address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </label>
                        @error('address')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4 border border-gray-300 rounded-lg p-4">
                    <h3 class="text-2xl font-bold pb-4">Pricing Details</h3>
                    <div class="">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            <input type="text" name="price" value="{{old('price')}}" placeholder="Price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </label>
                        @error('price')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>
                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="delivery_price" value="{{old('delivery_price')}}"
                                       placeholder="Delivery price*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('delivery_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="packaging_price" value="{{old('packaging_price')}}"
                                       placeholder="Packaging price*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('packaging_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="partner_cod_price" value="{{old('partner_cod_price')}}"
                                       placeholder="Partner cod price"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('partner_cod_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                            </label>
                            <input type="text" name="partner_delivery_price" value="{{old('partner_delivery_price')}}"
                                   placeholder="Partner delivery price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('partner_delivery_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="return_price" value="{{old('return_price')}}"
                                       placeholder="Return price"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('return_price')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="partner_return" value="{{old('partner_return')}}"
                                       placeholder="Return partner"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('partner_return')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="cod_to_pay" value="{{old('cod_to_pay')}}"
                                       placeholder="Cod to pay"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('cod_to_pay')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                        <div class="grow">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                <input type="text" name="commission" value="{{old('commission')}}"
                                       placeholder="Commission"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </label>
                            @error('commission')
                            <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="space-y-4 border border-gray-300 rounded-lg p-4">
                    <h3 class="text-2xl font-bold pb-4">Delivery Details</h3>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            <input type="text" name="status_id" value="{{old('status_id')}}"
                                   placeholder="Select a status"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </label>
                        @error('status_id')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center gap-8">
                            <label class="block mb-2 text-lg font-medium text-gray-900">
                                <input type="radio" name="free_delivery" value="true">
                                Free Delivery
                            </label>
                            <label class="block mb-2 text-lg font-medium text-gray-900">
                                <input type="radio" name="free_delivery" value="false">
                                Paid Delivery
                            </label>
                        </div>
                        @error('free_delivery')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center gap-8">
                            <label class="block mb-2 text-lg font-medium text-gray-900">
                                <input type="radio" name="can_be_opened" value="true">
                                Can be Opened
                            </label>
                            <label class="block mb-2 text-lg font-medium text-gray-900">
                                <input type="radio" name="can_be_opened" value="false">
                                Can't be Opened
                            </label>
                        </div>
                        @error('can_be_opened')
                        <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="grow px-4 py-2 font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg">
                        Create
                    </button>
                    <button type="reset"
                            class="grow px-4 py-2 font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg">Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
@endcomponent
