<?php

namespace Tests\Unit;

use App\Dominios\Clients\Client;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $clientData;

    protected function setUp(): void
    {
        $this->clientData = [
            'name' => 'João Souza',
            'cpf' => '057.834.610-91',
            'phone' => '(38) 9 9910-5500',
            'email' => 'joao@email.com',
            'birth_date' => Carbon::createFromFormat('Y-m-d', '1986-06-25'),
        ];
    }

    /**
     * Tests the creation of a new client without mandatory attributes
     *
     * @return void
     */
    public function test_create_new_client_with_require()
    {
        $client = new Client(
            $this->clientData['name'],
            $this->clientData['cpf'],
            $this->clientData['phone'],
            $this->clientData['email']
        );

        $this->assertEquals($this->clientData['name'], $client->getName());
        $this->assertEquals($this->clientData['cpf'], $client->getCpf());
        $this->assertEquals($this->clientData['phone'], $client->getPhone());
        $this->assertEquals($this->clientData['email'], $client->getEmail());
    }

    /**
     * Tests the creation of a new client with mandatory attributes
     *
     * @return void
     */
    public function test_create_new_client_without_require()
    {
        $client = (new Client(
            $this->clientData['name'],
            $this->clientData['cpf'],
            $this->clientData['phone'],
            $this->clientData['email']
        ))->setBirthDate($this->clientData['birth_date']);

        $this->assertEquals($this->clientData['name'], $client->getName());
        $this->assertEquals($this->clientData['cpf'], $client->getCpf());
        $this->assertEquals($this->clientData['phone'], $client->getPhone());
        $this->assertEquals($this->clientData['email'], $client->getEmail());
        $this->assertEquals($this->clientData['birth_date']->format('Y-m-d'), $client->getBirthDate()->format('Y-m-d'));
    }
}
