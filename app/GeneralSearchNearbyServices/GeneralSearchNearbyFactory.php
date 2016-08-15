<?php namespace App\GeneralSearchNearbyServices;

class GeneralSearchNearbyFactory
{
    protected $searchArray;

    function __construct($searchArray) {
        $this->searchArray = $searchArray;
    }

    function make($name) {
        $classOrFunc = $this->searchArray[$name];
        if (is_callable($classOrFunc)) {
            return $classOrFunc();
        } else {
            return new $classOrFunc();
        }
    }
}