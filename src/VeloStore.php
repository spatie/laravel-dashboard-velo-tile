<?php

namespace Spatie\VeloTile;

use Spatie\Dashboard\Models\Tile;
use Illuminate\Support\Collection;

class VeloStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("velo");
    }

    public function setStations(array $stations): self
    {
        $this->tile->putData('stations', $stations);

        return $this;
    }

    public function stations(): Collection
    {
        return collect($this->tile->getData('stations') ?? [])
            ->map(fn (array $veloStationAttributes) => new VeloStation($veloStationAttributes));
    }
}
