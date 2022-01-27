<?php

namespace App\Contracts\Clients;


use App\Contracts\Common\ResponseApiInterface;
use App\Dominios\Clients\Client;

interface ClientResponseApiInterface extends ResponseApiInterface
{
    public function toResponse();

    public function toArray(Client $client);

    public static function create($data);

}
