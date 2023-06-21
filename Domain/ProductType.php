<?php

class ProductType {
    private $id;
    private $name;
    private $taxPercentage;

    public function __construct( $name, $taxPercentage)
    {
        $this->setName($name);
        $this->setTaxPercentage($taxPercentage);
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

    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }
}

?>
