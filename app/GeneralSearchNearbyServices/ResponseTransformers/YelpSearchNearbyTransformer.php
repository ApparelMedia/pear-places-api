<?php namespace App\GeneralSearchNearbyServices\ResponseTransformers;

use App\Support\Contracts\TransformerInterface;
use App\DTOs\GeneralNearbyPlace;
use Illuminate\Support\Collection;

class YelpSearchNearbyTransformer extends AbstractSearchNearbyTransformer implements TransformerInterface
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
        $results = $this->response->businesses;
        $collection = new Collection();

        foreach($results as $place) {
            $dto = $this->transform($place);
            $collection->push($dto);
        }
        return $collection;
    }

    protected function transform($entity) {
        $lat = $entity->coordinates->latitude;
        $long = $entity->coordinates->longitude;
        return new GeneralNearbyPlace([
            'name' => $entity->name,
            'lat' => $lat,
            'long' => $long,
            'distance' => $this->getDistance($lat, $long),
        ]);
    }
}