<?php namespace App\DTOs;

class AbstractDTO
{
    function __construct(array $data) {
        foreach($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}