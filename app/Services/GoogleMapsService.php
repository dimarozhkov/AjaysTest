<?php

namespace App\Services;

use Exception;

class GoogleMapsService
{
    public static function getCoordinates(string $address)
    {
        try {
            $address = urlencode($address);
            $key = config('services.googleapis.maps.key');

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=$key";

            $jsondata = json_decode(@file_get_contents($url),true);

            return [
                'latitude' => $jsondata["results"][0]["geometry"]["location"]["lat"],
                'longitude' => $jsondata["results"][0]["geometry"]["location"]["lng"],
            ];
        } catch (Exception $ex) {
            logger()->info($ex->getMessage());
            return [
                'latitude' => 0.0,
                'longitude' => 0.0,
            ];
        }
    }
}
