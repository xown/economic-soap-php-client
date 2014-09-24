<?php


namespace Economic\Api;


use Economic\Client;

class Service
{
    protected $client;

    public function __construct(Client $base)
    {
        $this->client = $base;
    }

    public function getClient()
    {
        return $this->client;
    }
}
