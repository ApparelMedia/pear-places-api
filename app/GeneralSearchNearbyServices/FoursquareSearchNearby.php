<?php namespace App\GeneralSearchNearbyServices;

use GuzzleHttp\Client;
use App\Support\Contracts\AbstractSearchNearbyService;

class FoursquareSearchNearby extends AbstractSearchNearbyService
{
    protected $apiKey;
    protected $appId;
    protected $appSecret;
    protected $transformerClass;
    protected $defaultType = '4d4b7105d754a06374d81259,4d4b7105d754a06376d81259';

    function __construct($appId, $appSecret, $transformerClass = null)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->transformerClass = $transformerClass;
    }

    public function searchNearby($lat, $long, $type = null, $radius = null) {

        $config = $this->getConfigArray($lat, $long, $type, $radius);

        $client = new Client();
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
        $res = $client->request('GET', $path, ['query' => $queries]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()), $lat, $long);
        return $transformer->getCollection();
    }

}