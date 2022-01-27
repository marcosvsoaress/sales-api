<?php

namespace App\Dominios\Clients;

use App\Models\ClientModel;

class ClientTranfer
{
    /**
     * @var ClientModel
     */
    private $clientModel;

    private function __construct($client)
    {
        $this->clientModel = $client;
    }

    /**
     * mapper ClientModel to entity of Supplier
     * @return Client
     */
    public function mapperToClient() : Client
    {
        return (new Client(
            $this->clientModel->name,
            $this->clientModel->cpf,
            $this->clientModel->phone,
            $this->clientModel->email
        ))->setId($this->clientModel->id)->setBirthDate($this->clientModel->birth_date);
    }

    /**
     * Creating a object Tranfer
     * @param $data
     * @return ClientTranfer
     */
    public static function create($data)
    {
        return new ClientTranfer($data);
    }

}
