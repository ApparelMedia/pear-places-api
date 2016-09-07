<?php namespace App\GeneralSearchNearbyServices\ResponseTransformers;

use AnthonyMartin\GeoLocation\GeoLocation;
use App\Support\Contracts\TransformerInterface;
use App\DTOs\GeneralNearbyPlace;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class GoogleSearchNearbyTransformer extends AbstractSearchNearbyTransformer implements TransformerInterface
{
    protected $response;
    protected $originLat;
    protected $originLong;

    function __construct($response, $originLat, $originLong)
    {
        $this->response = $response;
        $this->originLat = $originLat;
        $this->originLong = $originLong;
    }

    public function getCollection()
    {
        $results = $this->response->results;
        $collection = new Collection();

        foreach($results as $place) {
            $dto = $this->transform($place);
            $collection->push($dto);
        }
        return $collection;
    }

    protected function transform($entity) {
        $lat = $entity->geometry->location->lat;
        $long = $entity->geometry->location->lng;

        return new GeneralNearbyPlace([
            'id' => $entity->place_id,
            'name' => $entity->name,
            'lat' => $lat,
            'long' => $long,
            'distance' => $this->getDistance($lat, $long),
            'address' => $entity->vicinity,
        ]);
    }


}