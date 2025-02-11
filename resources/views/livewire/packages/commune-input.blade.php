<div class="flex gap-2 w-full" x-data="{openCommune:false}">
        <div class="grow">
            <label class="block mb-2 text-sm font-medium text-gray-900">
                <select
                    wire:model.live="wilayaId"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" disabled selected>Select wilaya</option>
                    @foreach($wilayat as $wilaya)
                        <option value="{{$wilaya->id}}">{{$wilaya->name}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="relative grow">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    <input type="hidden" name="commune_id" value="{{$communeSelectedId}}">
                    <input type="text" wire:model.live.debounce="communeQuery" x-on:click="openCommune = !openCommune"
                           x-on:click.away="openCommune = false"
                           placeholder="Commune*"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </label>
                @error('commune_id')
                <em class="text-sm text-red-600 font-medium"> {{$message}}</em>
                @enderror
            </div>
            @if(!empty($communeResults))
                <ul class="absolute w-full bg-white border rounded mt-1 shadow-md" x-show="openCommune" x-cloak>
                    @forelse($communeResults as $result)
                        <li wire:click="selectResult({{ $result->id }}, '{{ $result->name }}')"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $result->name }}
                        </li>
                    @empty
                        <li class="p-2">
                            Nothing found
                        </li>
                    @endforelse
                </ul>
            @endif
        </div>
</div>
