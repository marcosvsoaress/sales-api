<?php

namespace App\Dominios\Clients;

use App\Contracts\Clients\ClientRepositoryInterface;
use App\Models\ClientModel;

class ClientRepository implements ClientRepositoryInterface
{

    /**
     * Create a new client
     *
     * @param Client $client
     * @return ClientModel
     */
    public function create(Client $client): Client
    {
        $clientModel = new ClientModel();
        $clientModel->name = $client->getName();
        $clientModel->cpf = $client->getCpf();
        $clientModel->email = $client->getEmail();
        $clientModel->phone = $client->getPhone();
        $clientModel->birth_date = $client->getBirthDate()->format('Y-m-d');
        $clientModel->save();

        $client->setId($clientModel->id);
        return $client;
    }

    /**
     * Get one client by ID
     *
     * @param int $clientId
     * @return Client|null
     */
    public function get(int $clientId): ?Client
    {
        $clientModel = ClientModel::where('id', $clientId)->first();
        return is_null($clientModel) ? $clientModel : ClientTranfer::create($clientModel)->mapperToClient();

    }

    /**
     * get all clients
     *
     * @return array
     */
    public function getAll(): array
    {
        $clientsModel = ClientModel::all();
        $clients = [];
        $clientsModel->each(function ($clientModel) use (&$clients) {
            array_push($clients, ClientTranfer::create($clientModel)->mapperToClient());
        });

        return $clients;
    }

    /**
     * Update a client
     *
     * @param Client $client
     * @return Client
     */
    public function update(Client $client): Client
    {

        $clientModel = ClientModel::find($client->getId());
        $clientModel->name = $client->getName();
        $clientModel->cpf = $client->getCpf();
        $clientModel->email = $client->getEmail();
        $clientModel->phone = $client->getPhone();
        $clientModel->birth_date = $client->getBirthDate()->format('Y-m-d');
        $clientModel->save();

        return is_null($clientModel) ? $clientModel : ClientTranfer::create($clientModel)->mapperToClient();
    }

    /**
     * remove a client
     *
     * @param int $clientId
     * @return bool
     */
    public function delete(int $clientId): bool
    {
        $clientModel = ClientModel::find($clientId);
        return $clientModel->delete();
    }
}
