<?php

namespace App\Dominios\Suppliers;

class Supplier
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $company_name;

    /**
     * @var string
     */
    private $trade_name;

    /**
     * @var string
     */
    private $cnpj;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    public function __construct(string $company_name, string $trade_name, string $cnpj, string $email, string $phone)
    {
        $this->company_name = $company_name;
        $this->trade_name = $trade_name;
        $this->cnpj = $cnpj;
        $this->email = $email;
        $this->phone = $phone;
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
     * @return Supplier
     */
    public function setId(int $id): Supplier
    {
        $this->id = $id;
        return $this;

    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->company_name;
    }

    /**
     * @param string $company_name
     * @return Supplier
     */
    public function setCompanyName(string $company_name): Supplier
    {
        $this->company_name = $company_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradeName(): string
    {
        return $this->trade_name;
    }

    /**
     * @param string $trade_name
     * @return Supplier
     */
    public function setTradeName(string $trade_name): Supplier
    {
        $this->trade_name = $trade_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return Supplier
     */
    public function setCnpj(string $cnpj): Supplier
    {
        $this->cnpj = $cnpj;
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
     * @return Supplier
     */
    public function setEmail(string $email): Supplier
    {
        $this->email = $email;
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
     * @return Supplier
     */
    public function setPhone(string $phone): Supplier
    {
        $this->phone = $phone;
        return $this;
    }


}
