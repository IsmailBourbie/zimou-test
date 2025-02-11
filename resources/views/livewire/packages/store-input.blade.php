<div class="relative" x-data="{open:false}">
    <input type="hidden" name="store_id" value="{{$selectedId}}">
    <input type="text" wire:model.live.debounce="query" x-on:click="open = !open" x-on:click.away="open = false" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
           placeholder="Select a store">

    @if(!empty($results))
        <ul class="absolute w-full bg-white border rounded mt-1 shadow-md" x-show="open" x-cloak>
            @forelse($results as $result)
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
