<?php

namespace App\Livewire\Packages;

use App\Models\Commune;
use App\Models\Store;
use App\Models\Wilaya;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CommuneInput extends Component
{

    public $communeQuery = '';
    public $communeResults = [];
    public $communeSelectedId = null;
    public $wilayaId = '';

    public function updatedWilayaId(): void
    {
        $this->communeSelectedId = null;
        $this->communeQuery = '';
        $this->communeResults = Commune::where('wilaya_id', $this->wilayaId)->take(5)->get();
    }

    public function updatedCommuneQuery(): void
    {
        if (empty($this->wilayaId)) {
            return;
        }
        $this->communeResults = Commune::where('wilaya_id', $this->wilayaId)->whereLike('name', '%'.$this->communeQuery.'%')->take(5)->get();
    }

    public function selectResult($id, $name): void
    {
        $this->communeQuery = $name;
        $this->communeSelectedId = $id;
        $this->communeResults = [];
    }

    public function render()
    {
        return view('livewire.packages.commune-input', [
            'wilayat' => Cache::remember('wilayat', 3600, fn() => Wilaya::all()),
        ]);
    }

}
