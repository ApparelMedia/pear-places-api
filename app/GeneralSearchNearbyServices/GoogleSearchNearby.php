<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class GoogleSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $transformerClass;
    protected $defaultType = 'bar';

    function __construct($apiKey, $transformerClass)
    {
        $this->apiKey = $apiKey;
        $this->transformerClass = $transformerClass;
    }

    public function searchNearby($lat, $long, $type = null, $radius = null) {
        $config = $this->getConfigArray($lat, $long, $type, $radius);
        $client = new Client();
        $path = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $queries = [
            'key' => $this->apiKey,
            'location' => "{$config['lat']},{$config['long']}",
            'radius' => $config['radius'],
            'type' => $config['type'],
        ];
        $res = $client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()));
        return $transformer->getCollection();
    }

}