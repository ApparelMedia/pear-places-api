# Pear Places API

## General Searches supported:
* Google Places API
* Yelp API v3
* Foursquare v2

## Sponsor Searches:
* Fake Miller Lite Locations

## Route
`{url}/places/nearby?lat={latitude}&long={longitude}&general={google|yelp|foursquare}`  
OR for miller lite  
`{url}/places/nearby?lat={latitude}&long={longitude}&sponsor=millerlite`

## Getting Started
1. copy the .env.example file to `.env` file
2. run `php artisan key:generate`
3. run `php artisan migrate`
4. run `php artisan db:seed` to seed the fake millerlite locations (will generate a bunch around Pear's office lat: 41.897561 and long: -87.636373)
2. You will need to get the credentials from google places, Yelp, and Foursquare developer console separately, and put it in the `.env` file.
