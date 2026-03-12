<?php

namespace Spatie\VeloTile;

use Illuminate\Contracts\View\View;
use Spatie\Dashboard\Components\BaseTileComponent;

class VeloTileComponent extends BaseTileComponent
{
    public function render(): View
    {
        return view('dashboard-velo-tile::tile', [
            'stations' => VeloStore::make()->stations(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.velo.refresh_interval_in_seconds') ?? 60,

        ]);
    }
}
