<?php

use \Mockery as m;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $this->app = $app;
        return $app;
    }

    protected function makeApiClientMockFunction($apiPath, $queryArray, $responseText)
    {
        return function () use ($apiPath, $responseText, $queryArray) {
            $client = m::mock(\GuzzleHttp\Client::class);
            $response = m::mock(\GuzzleHttp\Psr7\Response::class);
            $response->shouldReceive('getBody')->once()->andReturn($responseText);
            $client->shouldReceive('request')
                ->with('GET', $apiPath, $queryArray)
                ->once()
                ->andReturn($response);
            return $client;
        };
    }
}
