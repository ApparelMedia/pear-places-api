<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class GoogleSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $transformerClass;
    protected $client;
    protected $defaultType = 'bar';

    function __construct($apiKey, $transformerClass, Client $client)
    {
        $this->apiKey = $apiKey;
        $this->transformerClass = $transformerClass;
        $this->client = $client;
    }

    public function searchNearby($lat, $long, $type = null, $radius = null) {
        $config = $this->getConfigArray($lat, $long, $type, $radius);
        $path = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $queries = [
            'key' => $this->apiKey,
            'location' => "{$config['lat']},{$config['long']}",
            'radius' => $config['radius'],
            'type' => $config['type'],
        ];
        $res = $this->client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()), $lat, $long);
        return $transformer->getCollection();
    }

}