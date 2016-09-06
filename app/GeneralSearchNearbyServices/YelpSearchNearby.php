<?php namespace App\GeneralSearchNearbyServices;

use App\Support\Contracts\AbstractSearchNearbyService;
use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\GenericProvider as OAuthProvider;

class YelpSearchNearby extends AbstractSearchNearbyService
{
    protected $appId;
    protected $appSecret;
    protected $transformerClass;
    protected $client;
    protected $defaultType = 'restaurants';

    function __construct($appId, $appSecret, $transformer, Client $client) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->transformerClass = $transformer;
    }

    protected function getAccessToken() {
        if (\Cache::has('yelpAccessKey')) {
            return \Cache::get('yelpAccessKey');
        }

        $provider = new OAuthProvider([
            'clientId' => $this->appId,
            'clientSecret' => $this->appSecret,
            'urlAuthorize' => '',
            'urlAccessToken' => 'https://api.yelp.com/oauth2/token',
            'urlResourceOwnerDetails' => '',
        ]);

        $accessToken = $provider->getAccessToken('client_credentials');
        $token = $accessToken->getToken();
        $expiresAt =  (int) $accessToken->getExpires(); // in seconds

        \Cache::put('yelpAccessKey', $token, $expiresAt / 60 );

        return $token;

    }

    public function searchNearby($lat, $long, $type = null, $radius = null)
    {
        $config = $this->getConfigArray($lat, $long, $type, $radius);

        $path = 'https://api.yelp.com/v3/businesses/search';
        $queries = [
            'latitude' => $config['lat'],
            'longitude' => $config['long'],
            'radius' => $config['radius'],
            'categories' => $config['type'],
        ];
        $res = $this->client->request('GET', $path, [
            'query' => $queries,
            'headers' => [
                'authorization' => "Bearer {$this->getAccessToken()}"
            ]
        ]);
        $transformer = new $this->transformerClass(json_decode($res->getBody()), $lat, $long);
        return $transformer->getCollection();
    }

}