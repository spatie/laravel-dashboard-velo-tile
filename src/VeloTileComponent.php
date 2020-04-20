<?php

namespace Spatie\VeloTile;

use Livewire\Component;

class VeloTileComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-velo-tile::tile', [
            'stations' => VeloStore::make()->stations(),
        ]);
    }
}
