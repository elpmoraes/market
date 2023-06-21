<?php

class Product {
    private $id;
    private $name;
    private $price;
    private $productType;

    public function __construct($name, $price, ProductType $productType)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setProductType($productType);
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getProductType()
    {
        return $this->productType;
    }

    public function setProductType(ProductType $productType)
    {
        $this->productType = $productType;
    }
}

?>
