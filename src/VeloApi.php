<?php

namespace Spatie\VeloTile;

use Illuminate\Support\Facades\Http;

class VeloApi
{
    public function getStations(array $stationIds = []): array
    {
        $stationInfo = Http::get('https://gbfs.smartbike.com/antwerp/1.0/nl/station_information.json')->json();
        $stationStatus = Http::get('https://gbfs.smartbike.com/antwerp/1.0/nl/station_status.json')->json();

        $statusById = collect($stationStatus['data']['stations'] ?? [])
            ->keyBy('station_id');

        return collect($stationInfo['data']['stations'] ?? [])
            ->filter(fn (array $station) => in_array($station['station_id'], $stationIds))
            ->values()
            ->mapWithKeys(function (array $station) use ($stationIds, $statusById) {
                $key = array_search($station['station_id'], $stationIds);
                $status = $statusById->get($station['station_id'], []);

                return [$key => [
                    'id' => $station['station_id'],
                    'name' => $station['name'],
                    'bikes' => $status['num_bikes_available'] ?? 0,
                    'slots' => $status['num_docks_available'] ?? 0,
                    'lat' => $station['lat'],
                    'lon' => $station['lon'],
                    'address' => $station['address'] ?? '',
                ]];
            })
            ->toArray();
    }
}
