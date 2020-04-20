<?php

namespace Spatie\VeloTile;

use Illuminate\Support\Facades\Http;

class VeloApi
{
    public function getStations(array $stationIds = []): array
    {
        $stations = Http::get('https://www.velo-antwerpen.be/availability_map/getJsonObject')->json();

        return collect($stations)
            ->filter(function ($station) use ($stationIds) {
                return in_array($station['id'], $stationIds);
            })->mapWithKeys(function ($station) use ($stationIds) {
                $key = array_search($station['id'], $stationIds);

                return [$key => $station];
            })->toArray();
    }
}
