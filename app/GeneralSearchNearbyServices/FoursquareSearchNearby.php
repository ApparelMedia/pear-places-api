<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class FoursquareSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $transformerClass;

    function __construct($appId, $appSecret, $transformerClass = null)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->transformerClass = $transformerClass;
    }

    public function searchNearby($lat, $long) {
        $client = new Client();
        $path = 'https://api.foursquare.com/v2/venues/search';
        $queries = [
            'client_id' => $this->appId,
            'client_secret' => $this->appSecret,
            'v' => '20160815',
            'intent' => 'browse',
            'll' => "$lat,$long",
            'radius' => $this->searchRadiusMeters,
            'categoryId' => '4d4b7105d754a06374d81259,4d4b7105d754a06376d81259'
        ];
        $res = $client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()));
        return $transformer->getCollection();
    }

}