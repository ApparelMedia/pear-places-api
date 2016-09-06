<?php namespace App\GeneralSearchNearbyServices\ResponseTransformers;

use AnthonyMartin\GeoLocation\GeoLocation;

class AbstractSearchNearbyTransformer
{
    protected $originLat;
    protected $originLong;

    protected function getDistance($lat, $long) {
        $destination = GeoLocation::fromDegrees($lat, $long);
        $origin = GeoLocation::fromDegrees($this->originLat, $this->originLong);
        $distanceInKm = $origin->distanceTo($destination, 'kilometers');
        return (int) ($distanceInKm * 1000);
    }
}