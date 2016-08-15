<?php namespace App\SponsorSearchNearbyServices;

use App\SponsoredLocation;
use App\Support\Contracts\AbstractSearchNearbyService;

class MillerLiteSearchNearbyService extends AbstractSearchNearbyService
{
    protected $vendorId = 84;

    public function searchNearby($lat, $long)
    {
        return SponsoredLocation::sponsorId($this->vendorId)->nearby($lat, $long, $this->searchRadiusMeters)->get();
    }
}