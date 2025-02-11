<?php

namespace App\Livewire\Packages;

use App\Models\Store;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class StoreInput extends Component
{

    public $query = '';
    public $results = [];
    public $selectedId = null;


    public function mount():void
    {
        $this->results =  Store::take(5)->get();
    }


    public function updatedQuery(): void
    {
        $this->results = Store::where('name', 'like', '%'.$this->query.'%')->take(5)->get();
    }

    public function selectResult($id, $name): void
    {
        $this->query = $name;
        $this->selectedId = $id;
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.packages.store-input', [
            'stores' => Store::limit(5)->get(),
        ]);
    }

}
