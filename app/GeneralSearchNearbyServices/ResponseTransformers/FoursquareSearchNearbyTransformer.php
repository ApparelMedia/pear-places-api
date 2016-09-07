<?php namespace App\GeneralSearchNearbyServices\ResponseTransformers;

use App\Support\Contracts\TransformerInterface;
use App\DTOs\GeneralNearbyPlace;
use Illuminate\Support\Collection;

class FoursquareSearchNearbyTransformer extends AbstractSearchNearbyTransformer  implements TransformerInterface
{
    protected $response;

    function __construct($response, $originLat, $originLong)
    {
        $this->response = $response;
        $this->originLat = $originLat;
        $this->originLong = $originLong;
    }

    public function getCollection()
    {
        $results = $this->response->response->venues;
        $collection = new Collection();

        foreach($results as $place) {
            $dto = $this->transform($place);
            $collection->push($dto);
        }
        return $collection;
    }

    protected function transform($entity) {
        $lat = $entity->location->lat;
        $long = $entity->location->lng;
        return new GeneralNearbyPlace([
            'id' => $entity->id,
            'name' => $entity->name,
            'lat' => $lat,
            'long' => $long,
            'distance' => $this->getDistance($lat, $long),
            'address' => isset($entity->location->address) ? $entity->location->address . ', ' . $entity->location->city : null,
        ]);
    }
}