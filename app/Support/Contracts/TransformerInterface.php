<?php namespace App\Support\Contracts;

interface TransformerInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCollection();
}