<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use AnthonyMartin\GeoLocation\GeoLocation as GeoLocation;

class SponsoredLocation extends Model
{
    public $timestamps = false;

    public function scopeSponsorId(Builder $query, $sponsorId) {
        return $query->where('sponsor_id', $sponsorId);
    }

    public function scopeNearby (Builder $query, $lat, $long, $radius) {
        $center = GeoLocation::fromDegrees($lat, $long);
        $boundingBox = $center->boundingCoordinates( $radius / 1000, 'kilometers');
        $minLat = $boundingBox[0]->getLatitudeInDegrees();
        $maxLat = $boundingBox[1]->getLatitudeInDegrees();
        $minLong = $boundingBox[0]->getLongitudeInDegrees();
        $maxLong = $boundingBox[1]->getLongitudeInDegrees();

        return $query
            ->where('lat', '>', $minLat)
            ->where('lat', '<', $maxLat)
            ->where('long', '>', $minLong)
            ->where('long', '<', $maxLong);
    }
}
