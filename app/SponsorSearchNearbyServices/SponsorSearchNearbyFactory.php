<?php namespace App\SponsorSearchNearbyServices;

use App\SponsoredLocation;
use App\Support\Contracts\AbstractSearchNearbyService;
use Illuminate\Support\Str;

class SponsorSearchNearbyFactory
{
    function __construct($searchArray)
    {
        $this->searchArray = $searchArray;
    }

    public function make($name)
    {
        $sponsorKey = strtolower(Str::camel($name));
        $className = $this->searchArray[$sponsorKey];
        return new $className();
    }
}