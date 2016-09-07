<?php

use Mockery as m;

class GoogleApiTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testMinimumRequiredParameterSuccess()
    {
        $mockClient = new \Tests\MockHttpClient\MockGooglePlacesApiClient($this->app);
        $mockClient->makeSuccess200meterClient([
            'key' => 'abc',
            'location' => "41.897435,-87.636268",
            'radius' => 200,
            'type' => 'bar',
        ]);

        $this->json('GET', '/places/nearby?lat=41.897435&long=-87.636268&radius=200')
            ->seeJsonStructure(['*' => ['type', 'lat', 'long', 'distance', 'name', 'address']]);
    }
}
