<?php

namespace App\Http\Controllers;

use App\GeneralSearchNearbyServices\GeneralSearchNearbyFactory;
use App\SponsorSearchNearbyServices\SponsorSearchNearbyFactory;
use Illuminate\Http\Request;

use App\Http\Requests;

class PlaceController extends Controller
{
    public function searchNearby(SponsorSearchNearbyFactory $sponsorFactory, GeneralSearchNearbyFactory $generalFactory) {
        $lat = request('lat');
        $long = request('long');
        $sponsor = request('sponsor');
        $general = request('general') ?: 'google';

        if ($sponsor) {
            $searchNearby = $sponsorFactory->make($sponsor);
        } else {
            $searchNearby = $generalFactory->make($general);
        }

        $result = $searchNearby->searchNearby($lat, $long);
        return response()->json($result);
    }
}
