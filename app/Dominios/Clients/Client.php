<?php

namespace App\Dominios\Clients;

use Carbon\Carbon;

class Client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cpf;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Carbon|null
     */
    private $birthDate = null;

    public function __construct(string $name, string $cpf, string $phone, string $email)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): Client
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Client
     */
    public function setName(string $name): Client
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return Client
     */
    public function setCpf(string $cpf): Client
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Client
     */
    public function setPhone(string $phone): Client
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Client
     */
    public function setEmail(string $email): Client
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getBirthDate(): Carbon
    {
        return $this->birthDate;
    }

    /**
     * @param Carbon $birthDate
     * @return Client
     */
    public function setBirthDate(Carbon $birthDate): Client
    {
        $this->birthDate = $birthDate;
        return $this;
    }
}
