<?php namespace App\Support\Contracts;

abstract class AbstractSearchNearbyService
{
    protected $searchRadiusMeters = 100;
    abstract public function searchNearby($lat, $long);

}