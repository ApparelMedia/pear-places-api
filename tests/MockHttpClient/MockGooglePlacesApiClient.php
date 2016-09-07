<?php namespace Tests\MockHttpClient;

use Mockery as m;

class MockGooglePlacesApiClient {

    protected $app;

    function __construct($app) {
        $this->app = $app;
    }

    public function makeSuccess200meterClient($expectedQueries) {
        $queryArray = ['query' => $expectedQueries];
        $apiPath = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $this->app->bind('GuzzleClient', $this->makeApiClientMockFunction($apiPath, $queryArray, $this->twoHundredMeters));
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

    protected $twoHundredMeters = '{ "html_attributions" : [], "results" : [ { "geometry" : { "location" : { "lat" : 41.8967165, "lng" : -87.6353879 }, "viewport" : { "northeast" : { "lat" : 41.89677949999999, "lng" : -87.63537289999999 }, "southwest" : { "lat" : 41.89652749999999, "lng" : -87.6353929 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/bar-71.png", "id" : "5950b13499aa3ef39bf047c17746c23badedf3b6", "name" : "Farmhouse", "opening_hours" : { "open_now" : true, "weekday_text" : [] }, "photos" : [ { "height" : 2340, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/103752878943694892388/photos\"\u003eHarish Thiru\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAGlo_IM3Qj1XXi5Y9bXHrnfXzb9iW6DcaY1IFSzBZNYmCf7nNPX_9FErtU-BVWfcqrtqx9bc3yih5lL0K5k3mqGBmxP2fhPBHvvCoqeMYATwSRYNq0mCtCuoLgBfvvR1LE5h3amIZqkisVg8ugbsftRZm7CLbtiwdaiiJaLN9kG8EhBdzskEQ-2EewTO54hTVN6aGhSGJ_N7d9O8OWzvCtFNmRFCnl4zNw", "width" : 4160 } ], "place_id" : "ChIJxZhBGEvTD4gR9wzs5Xhfuhg", "price_level" : 2, "rating" : 4.5, "reference" : "CmRcAAAAtt3487dcErhBREFef4fl-ngcqGFwiRZU2mAczQVIcpqjtgBYL0EKnGfONX51jpCgHVoY0gi-jy3xoj8_aIYJQu9HKlNpU6sytCkeHilvik4Q6y3DspHi_awivgvD22n3EhBqJwb7c93GJgKKDXocnofrGhTuMTbJn7xX3rDEF19Z4H3DF6d6nQ", "scope" : "GOOGLE", "types" : [ "bar", "restaurant", "food", "point_of_interest", "establishment" ], "vicinity" : "228 West Chicago Avenue, Chicago" }, { "geometry" : { "location" : { "lat" : 41.89854, "lng" : -87.636079 }, "viewport" : { "northeast" : { "lat" : 41.89855140000002, "lng" : -87.63561025000001 }, "southwest" : { "lat" : 41.8985362, "lng" : -87.63623524999998 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png", "id" : "5a653d94ef89132932584b5340bf0d300064157c", "name" : "mk", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 4096, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/111186018907967263925/photos\"\u003emk\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAAP7hf51ClqpyAIb8nO8TNtbteH5Q42_weTMGoHsWTPxUf-uuYcqCbYInQYNOjsWEmCPiewo3MGX3X0rU1g1ADRK30I3Gqt4qp_wwK0Wvho5ZCU8L8bBzGErffyINwEBhMa-S__Ai4i3cpt5-CtVMeXZSXzUZUxE8HDP0ebuknw2EhAr-fhJB-1PK1_pIYSVp3GHGhR2dNKLCco49_G9lgWzbtwk3029ug", "width" : 6144 } ], "place_id" : "ChIJBWjMskvTD4gR3A7fMpkRhBk", "price_level" : 3, "rating" : 4.5, "reference" : "CmRVAAAATS8qYRcLx0O-2mnEwJg4zWFBKaJehl_lZ43eeZ5qBYE1RXerjtzUoqHMuZaIN3-ZOoJzEnpZLZE7lAk_JoC5UZkwRuO8-P9FLQiHiinRb7OZUkviLDwFz-LaEu8jOVCKEhAIcD4x8anhN-LBZmSQStyzGhSKN6c9HBfstqwl8qNWm7lmrsumNg", "scope" : "GOOGLE", "types" : [ "bar", "restaurant", "food", "point_of_interest", "establishment" ], "vicinity" : "868 North Franklin Street, Chicago" }, { "geometry" : { "location" : { "lat" : 41.89684, "lng" : -87.63680549999999 }, "viewport" : { "northeast" : { "lat" : 41.8969823, "lng" : -87.63658065 }, "southwest" : { "lat" : 41.89641309999999, "lng" : -87.63688044999999 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/bar-71.png", "id" : "f89774f5f28a32a7d692808d7203b0124add2a25", "name" : "Parliament Chicago", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 357, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/100421795888819670960/photos\"\u003eParliament Chicago\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAIvrLoIFXTGgy_fFPimM5xBlC7ah7u5_LE0o1QMAxPtwtvhCe8m2tiQV-M4GkGwF2QKZf215GCQu23QSDtgcnt_4NQAiuxA7cSE0OiwappCWapd0HLJndpw8cJe4_XggfWc_9nSKkiAo1fJyx4erBYcIgno2Qq2NEUQtKGUBduXQEhCrfLIqfKMN-eGtrRG06TW3GhRB0NFacwOv-tsjIHmlbDInmqbsBA", "width" : 575 } ], "place_id" : "ChIJ3zlw6UrTD4gR5aJE7kR1q2M", "rating" : 3.2, "reference" : "CnRlAAAAIs4FjmqoJho8asSDbfg1Yv7KWowNwvIa7i0OLk3Ek636Bzfk-Viv-VjpqA6Ek4U3OflCUlMkKuH_DApO26_XzHkB-guWIWz5TdrDpI8uPwX0P4XoUJC1aZUs-iqZZSmtL82qfo0k--BEO9ne_JvNShIQtGNOi5b2g-EbyZG-ElnPuxoUa3UXXKEjlmZehx52qEFU8bJDASM", "scope" : "GOOGLE", "types" : [ "night_club", "bar", "point_of_interest", "establishment" ], "vicinity" : "324 West Chicago Avenue, Chicago" }, { "geometry" : { "location" : { "lat" : 41.898674, "lng" : -87.6370828 }, "viewport" : { "northeast" : { "lat" : 41.89867570000001, "lng" : -87.6369983 }, "southwest" : { "lat" : 41.8986689, "lng" : -87.63733629999999 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/bar-71.png", "id" : "cb55888872863c698ea9cacd55b33ae312cd01af", "name" : "Bodi Chicago", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "place_id" : "ChIJlfelQ0rTD4gRjs-_kMClvh0", "reference" : "CmRfAAAAbAbbPgaswe6ORyUQgav3ASIefVZPNEmB3YRfyl8LsehHOl7opteiax_hTH9ZQyDWt8JpnuZp_cl4ySiRjzjIsohnJTDaPCDUrfXRvRBCWPdNNbiB9eQA3G6qkjb73Lh2EhDkQhLLiGpVG7jH0iHrgxYKGhQ9nk9uGcd9CwtpExZWRTDdLM8x-Q", "scope" : "GOOGLE", "types" : [ "bar", "point_of_interest", "establishment" ], "vicinity" : "873 North Orleans Street, Chicago" }, { "geometry" : { "location" : { "lat" : 41.8967131, "lng" : -87.63527979999999 }, "viewport" : { "northeast" : { "lat" : 41.89677575, "lng" : -87.6352533 }, "southwest" : { "lat" : 41.89652515, "lng" : -87.6353593 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png", "id" : "7dfae7d1fa38a080393326d347604fa4783ed447", "name" : "Bistro Voltaire", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 592, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/114579643600487973164/photos\"\u003eBistro Voltaire\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAAPqKSLL1l9HMZE23ysaKH9Sky1A87tPcgozU4frrrrdVCHlA83B14M7UM1R2nklRqk9RT33Gh7hI-xyekSN1UiOcS3kGpOkLYKlm0Qj16w7RdZFRKv1RCIJ0FJWW_L14i2CZndJgBOR7jQqCFpzU7TImYmansGJEPQaDQMIQDP6EhBFLk_rwnzHOEn-2bb1iREeGhQKDlJ_z0e90MjtkoLN6yspL0Bx-A", "width" : 592 } ], "place_id" : "ChIJWdnnGUvTD4gR_373wYWuXMY", "rating" : 4.2, "reference" : "CnRjAAAAV0vEGoRwvPLz5m4tNu8F85T4oA1Y_A5qcw3dxB3-MREbeHgMJL-whubsDzCh4Hzzo3jCLX9Subv92Y8wTmE2YBDhF-DbbKoLBAIzxBmxHF-KMVPX3eFO0dcRPHYR3X48VvxB-53U2E93FS1S09Q8eBIQeqlwXDlsAN84bt95TCqRQBoUOWeaGDdLxBV0cDab62_fVfg-XVQ", "scope" : "GOOGLE", "types" : [ "bar", "restaurant", "food", "point_of_interest", "establishment" ], "vicinity" : "226 West Chicago Avenue, Chicago" }, { "geometry" : { "location" : { "lat" : 41.899206, "lng" : -87.63614 }, "viewport" : { "northeast" : { "lat" : 41.8992132, "lng" : -87.63560105000001 }, "southwest" : { "lat" : 41.8992036, "lng" : -87.63631965 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png", "id" : "46f9970f4d1037e5648988173f28e4647e76eec2", "name" : "Kiki\'s Bistro", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 2047, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/109332018962433369291/photos\"\u003eKiki\'s Bistro\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAJCH0v4vS6cjqlTe9o3BzbahHzVGUhy8i13376PD1RSwyNsRqA2SsH-doL1n1A5nRlzyNlZhYJIWH8h2xdnnCDQ0PPTO1UNeJFr9xgF1aRDsJvUqoxx-MH5NO8Lytrmmqvs2rzDD7YkoSy6tEabIX9spQX6nbbpkns9lAtQAq3RUEhC_8r8OQa3XCImb_XClZKHCGhQ5JnbZ88fxZoNCDrrD39Ksw442nA", "width" : 2048 } ], "place_id" : "ChIJG1ozNUrTD4gR-Z9al75BoDM", "price_level" : 3, "rating" : 4.4, "reference" : "CmRgAAAAOiiNfz_cslGAboDACZ4QHWh8foF5IAg9ZIZTZ_DlKZH0GWGJGNj_Tw-0d4GNENsbbNh8du4c7Fc1aTp0zXxngDnqFIi9vpswolc3vrRu07qd7BVlsCM55nAyAQjOqDw2EhAv2onN9OlwbD9BmPuZtNAOGhRVw_pv-m8BwMGeDDmNG30Qyj4RiQ", "scope" : "GOOGLE", "types" : [ "art_gallery", "bar", "restaurant", "food", "point_of_interest", "establishment" ], "vicinity" : "900 North Franklin Street, Chicago" }, { "geometry" : { "location" : { "lat" : 41.8967677, "lng" : -87.636797 }, "viewport" : { "northeast" : { "lat" : 41.896876, "lng" : -87.63677765 }, "southwest" : { "lat" : 41.8964428, "lng" : -87.63680345 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/bar-71.png", "id" : "bf3e1592aa77b4c66d4b30c255e47432e8788fd6", "name" : "The Kensington Roof Garden & Lounge", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 533, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/107433760904739272041/photos\"\u003eThe Kensington Roof Garden & Lounge\u003c/a\u003e" ], "photo_reference" : "CoQBcwAAAK98aaEU7CYJPTim1U0A2Zj_FPURQeiKiq-gBimPYCKeWTwkPim_b8Leo2FPOO8YuXjDBOStk-yDetMa3fGT_FRKQDKhQQpUk9DVuRJRpABrtaKe3_dFGbvaG874aIYtDyvnhUgcD8zkHuqgokV3LFA8B0wtEHbb6VUuRjptlqPzEhDBya1Nd1oM4vuNgj6HbsPeGhRGxk0hL6mO2xvYrtZmITe9UZmyog", "width" : 533 } ], "place_id" : "ChIJQW786ErTD4gRNVmKLcozmpA", "rating" : 3.8, "reference" : "CoQBdwAAALJ1Jjz-Bz-tlceYz9hLMR5tBsBJbZD4aEKXYcKjXQPCD2kBMZ8TGILB7uHLIsBL4g_bS4xLgx5pVzDuAD-uChOvo7ckVC25cKJZQz0hu6N4XfQsDidgTMiO3LjLFM2SV7STsFjXgq5EdxkgrUDlQ1GNLmsVMX1icYlXl7KKoT4jEhBsjsSc4ttX2Sbh6bAzkG8UGhT4vhfgtmyPGYCzkzB-RqKvGU-nMA", "scope" : "GOOGLE", "types" : [ "night_club", "bar", "point_of_interest", "establishment" ], "vicinity" : "324 West Chicago Avenue, Chicago" }, { "geometry" : { "location" : { "lat" : 41.8971809, "lng" : -87.6352357 }, "viewport" : { "northeast" : { "lat" : 41.89749245, "lng" : -87.63523434999999 }, "southwest" : { "lat" : 41.89707704999999, "lng" : -87.63523975000001 } } }, "icon" : "https://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png", "id" : "84733763451f491fc6ac73659acc034b108703f5", "name" : "Headquarters Beercade- River North", "opening_hours" : { "open_now" : false, "weekday_text" : [] }, "photos" : [ { "height" : 2988, "html_attributions" : [ "\u003ca href=\"https://maps.google.com/maps/contrib/104723279104760653499/photos\"\u003eJeewant Kaushal\u003c/a\u003e" ], "photo_reference" : "CoQBdwAAAMj6bGHlTNGAKe7PSbaCgpWUsSXGfCqoIWWXNh76EY5LCQOzv9O46nzTl1DEwyxmAa7K4aY4FI4ZnDrJujOICKsp985wjBW7vq561T9lWtFCd1qgKMA5O3CpH3hT8qUy1lCNDJCamjY3j40QRzH_ZdAGW83VUCbUIIHIu15P4YW-EhDIs8G4COnEdnPQezRdLWwcGhRthqzCPT8WXI7yIxh9pZHs2OEtyQ", "width" : 5312 } ], "place_id" : "ChIJfds8EEvTD4gR4NHirhe7O3c", "price_level" : 2, "rating" : 4.2, "reference" : "CoQBdQAAACKz3fJr7_ZdR7gWkc_dwGycj8W2ey2fhnYGOfLnf20SP-PCXbvvsCBIhjoTQRj0CyL1dx1BUDPlr4d261VTezr7zz_bFGFm4byBBdbYP8b8wrNk623RVQMVGaUaxhVYHAJ3-zVNYs0CvF4xwoynAy5FycVhIA0wR7efRB-NdVC8EhBNPpG4Goc-3krc9iJi0nUUGhQoz_rRAquAHIxxifQp7M2FSQ8tlg", "scope" : "GOOGLE", "types" : [ "bar", "restaurant", "food", "point_of_interest", "establishment" ], "vicinity" : "213 West Institute Place, Chicago" } ], "status" : "OK" }';
}