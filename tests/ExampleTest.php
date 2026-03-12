<?php

use Spatie\VeloTile\VeloStation;
use Spatie\VeloTile\VeloStore;

it('can create a velo store', function () {
    $store = VeloStore::make();

    expect($store)->toBeInstanceOf(VeloStore::class);
});

it('can set and retrieve stations', function () {
    $store = VeloStore::make();

    $store->setStations([
        ['name' => '001 - Station A', 'bikes' => 5, 'slots' => 10],
        ['name' => '002 - Station B', 'bikes' => 0, 'slots' => 15],
    ]);

    $stations = VeloStore::make()->stations();

    expect($stations)->toHaveCount(2);
    expect($stations->first())->toBeInstanceOf(VeloStation::class);
});

it('can get station short name', function () {
    $station = new VeloStation(['name' => '001 - Central', 'bikes' => 5]);

    expect($station->shortName())->toBe('- Central');
});

it('can get the number of bikes available', function () {
    $station = new VeloStation(['name' => '001 - Central', 'bikes' => 5]);

    expect($station->numberOfBikesAvailable())->toBe(5);
});

it('knows when a station is empty', function () {
    $empty = new VeloStation(['name' => '001 - Empty', 'bikes' => 0]);
    $notEmpty = new VeloStation(['name' => '002 - Full', 'bikes' => 5]);

    expect($empty->isEmpty())->toBeTrue();
    expect($notEmpty->isEmpty())->toBeFalse();
});

it('knows when a station is nearly empty', function () {
    $nearlyEmpty = new VeloStation(['name' => '001 - Low', 'bikes' => 2]);
    $ok = new VeloStation(['name' => '002 - Ok', 'bikes' => 5]);

    expect($nearlyEmpty->isNearlyEmpty())->toBeTrue();
    expect($ok->isNearlyEmpty())->toBeFalse();
});

it('returns the correct display class', function () {
    $empty = new VeloStation(['name' => '001 - Empty', 'bikes' => 0]);
    $nearlyEmpty = new VeloStation(['name' => '002 - Low', 'bikes' => 2]);
    $ok = new VeloStation(['name' => '003 - Ok', 'bikes' => 5]);

    expect($empty->displayClass())->toBe('line-through');
    expect($nearlyEmpty->displayClass())->toBe('text-error');
    expect($ok->displayClass())->toBe('');
});
