<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class FoursquareSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $appId;
    protected $appSecret;
    protected $client;
    protected $transformerClass;
    protected $defaultType = '4d4b7105d754a06374d81259,4d4b7105d754a06376d81259';

    function __construct($appId, $appSecret, $transformerClass = null, Client $client)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->transformerClass = $transformerClass;
        $this->client = $client;
    }

    public function searchNearby($lat, $long, $type = null, $radius = null) {

        $config = $this->getConfigArray($lat, $long, $type, $radius);

        $path = 'https://api.foursquare.com/v2/venues/search';
        $queries = [
            'client_id' => $this->appId,
            'client_secret' => $this->appSecret,
            'v' => '20160815',
            'intent' => 'browse',
            'll' => "{$config['lat']},{$config['long']}",
            'radius' => $config['radius'],
            'categoryId' => $config['type'],
        ];
        $res = $this->client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()), $lat, $long);
        return $transformer->getCollection();
    }

}