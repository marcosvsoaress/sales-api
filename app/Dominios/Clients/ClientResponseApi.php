<?php

namespace App\Dominios\Clients;

use App\Contracts\Clients\ClientResponseApiInterface;
use App\Dominios\Common\ResponseApi;

class ClientResponseApi extends ResponseApi implements ClientResponseApiInterface
{
    private $data = null;

    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates a response Formated to be sending to the client
     *
     * @param bool $withHeader
     * @return array
     */
    public function toResponse(bool $withHeader = true): array
    {
        if (is_null($this->data) || empty($this->data)) {
            if(!$withHeader){
                return [];
            }
            return self::responseJson('Client not found');
        }

        $data = [];
        if (is_array($this->data)) {
            $clients = $this->responseList();
            if(!$withHeader){
                return $clients;
            }
            $data['clients'] = $clients;
        } else {
            $client = $this->toArray($this->data);
            if(!$withHeader){
                return $client;
            }
            $data['client'] = $client;
        }
        return self::responseJson('', $data);
    }

    /**
     * create a array of products
     */
    private function responseList(){
        $products = [];
        foreach ($this->data as $product) {
            array_push($products, $this->toArray($product));
        }
        return $products;
    }

    /**
     * format Object to Array
     *
     * @param Client $client
     * @return array
     */
    public function toArray(Client $client)
    {
        return [
            'id' => $client->getId(),
            'name' => $client->getName(),
            'cpf' => $client->getCpf(),
            'phone' => $client->getPhone(),
            'email' => $client->getEmail(),
            'birth_date' => $client->getBirthDate()->format('Y-m-d'),
        ];
    }

    /**
     * Create a new clientResponse
     *
     * @param $data
     * @return ClientResponseApi
     */
    public static function create($data)
    {
        return new ClientResponseApi($data);
    }
}
