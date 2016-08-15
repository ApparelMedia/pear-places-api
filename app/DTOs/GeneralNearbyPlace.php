<?php namespace App\DTOs;
/**
 * Class NearbyPlace
 * @package App\DTOs
 */
class GeneralNearbyPlace extends AbstractDTO
{
    public $type = 'general';
    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $long;
}