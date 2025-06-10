<?php

declare(strict_types=1);

namespace Domain\Entities;

class Customer
{
    private $id;
    private $fullname;
    private $email;
    private $total_purchase_amount;

    public function __construct($id = null, $name = null, $email = null)
    {
        $this->id = $id;
        $this->fullname = $name;
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function setFullName($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTotalPurchaseAmount()
    {
        return $this->total_purchase_amount ?? 0;
    }

    public function setTotalPurchaseAmount($total_purchase_amount)
    {
        $this->total_purchase_amount = $total_purchase_amount;
    }
}
