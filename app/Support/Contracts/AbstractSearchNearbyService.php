<?php namespace App\Support\Contracts;

abstract class AbstractSearchNearbyService
{
    protected $searchRadiusMeters = 100;
    protected $defaultType;

    abstract public function searchNearby($lat, $long, $type, $radius);
    protected function getConfigArray($lat, $long, $type, $radius) {
        $output = compact('lat', 'long', 'type', 'radius');

        if (is_null($type)) {
            $output['type'] =  $this->defaultType;
        }

        if (is_null($radius) or $radius === 0) {
            $output['radius'] = config('search.default_radius');
        }

        return $output;
    }
}