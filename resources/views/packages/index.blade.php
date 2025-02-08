@component('layouts.base', ['title' => 'Packages'])
    <h2 class="text-lg">ALl Packages</h2>
    @foreach($packages as $package)
        <div>{{$package->name}}</div>
    @endforeach
@endcomponent
