<?php namespace App\Providers;

use App\GeneralSearchNearbyServices\FoursquareSearchNearby;
use App\GeneralSearchNearbyServices\GeneralSearchNearbyFactory;
use App\GeneralSearchNearbyServices\GoogleSearchNearby;
use App\GeneralSearchNearbyServices\ResponseTransformers\FoursquareSearchNearbyTransformer;
use App\GeneralSearchNearbyServices\ResponseTransformers\GoogleSearchNearbyTransformer;
use App\GeneralSearchNearbyServices\ResponseTransformers\YelpSearchNearbyTransformer;
use App\GeneralSearchNearbyServices\YelpSearchNearby;
use App\SponsorSearchNearbyServices\SponsorSearchNearbyFactory;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class SearchNearbyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleClient', function() {
            return new Client();
        });

        $generalSearches = [
            'google' => function () {
                return new GoogleSearchNearby(env('GOOGLE_API_KEY'), GoogleSearchNearbyTransformer::class, app('GuzzleClient'));
            },
            'yelp' => function () {
                return new YelpSearchNearby(env('YELP_APP_ID'), env('YELP_APP_SECRET'), YelpSearchNearbyTransformer::class, app('GuzzleClient'));
            },
            'foursquare' => function () {
                return new FoursquareSearchNearby(env('FOURSQUARE_CLIENT_ID'), env('FOURSQUARE_CLIENT_SECRET'), FoursquareSearchNearbyTransformer::class, app('GuzzleClient'));
            },
        ];

        $this->app->singleton('App\GeneralSearchNearbyServices\GeneralSearchNearbyFactory', function () use ($generalSearches) {
            return new GeneralSearchNearbyFactory($generalSearches);
        });

        $this->app->singleton('App\SponsorSearchNearbyServices\SponsorSearchNearbyFactory', function () {
            return new SponsorSearchNearbyFactory(config('sponsors.search'));
        });
    }

    public function provides()
    {
        return ['GeneralSearchNearbyService'];
    }
}