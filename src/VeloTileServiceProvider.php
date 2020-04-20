<?php

namespace Spatie\VeloTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class VeloTileServiceProvider extends ServiceProvider
{
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchVeloStationsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-velo-tile');

        Livewire::component('dashboard-velo-tile::tile', VeloTileComponent::class);
    }
}
