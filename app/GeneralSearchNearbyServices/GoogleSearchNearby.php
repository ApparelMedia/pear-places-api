<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class GoogleSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $transformerClass;

    function __construct($apiKey, $transformerClass)
    {
        $this->apiKey = $apiKey;
        $this->transformerClass = $transformerClass;
    }

    public function searchNearby($lat, $long) {
        $client = new Client();
        $path = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $queries = [
            'key' => $this->apiKey,
            'location' => "$lat,$long",
            'radius' => $this->searchRadiusMeters,
            'type' => 'bar',
        ];
        $res = $client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()));
        return $transformer->getCollection();
    }

}