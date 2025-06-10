<?php

declare(strict_types=1);

namespace Domain\Entities;

class Category
{
    private $id;
    private $name;
    private $description;
    private $products_count;

    public function __construct($id = null, $name = null, $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getProductsCount()
    {
        return $this->products_count;
    }

    public function setProductsCount($productsCount)
    {
        $this->products_count = $productsCount;
    }
}
