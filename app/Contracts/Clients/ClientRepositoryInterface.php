<?php

namespace App\Contracts\Clients;

use App\Dominios\Clients\Client;
use App\Models\ClientModel;

interface ClientRepositoryInterface
{
    /**
     * @param Client $client
     * @return bool
     */
    public function create(Client $client) : Client;

    /**
     * @param int $clientId
     * @return Client
     */
    public function get(int $clientId) : ?Client;

    /**
     * @return array
     */
    public function getAll() : array;

    /**
     * @param Client $client
     * @return bool
     */
    public function update(Client $client) : Client;

    /**
     * @param int $clientId
     * @return bool
     */
    public function delete(int $clientId) : bool;
}
