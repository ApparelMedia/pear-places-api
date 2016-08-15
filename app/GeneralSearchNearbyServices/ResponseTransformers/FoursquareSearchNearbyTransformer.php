<?php namespace App\GeneralSearchNearbyServices\ResponseTransformers;

use App\Support\Contracts\TransformerInterface;
use App\DTOs\GeneralNearbyPlace;
use Illuminate\Support\Collection;

class FoursquareSearchNearbyTransformer implements TransformerInterface
{
    protected $response;

    function __construct($response)
    {
        $this->response = $response;
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
        return new GeneralNearbyPlace([
            'name' => $entity->name,
            'lat' => $entity->location->lat,
            'long' => $entity->location->lng,
        ]);
    }
}