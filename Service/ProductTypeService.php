<?php

require_once './Repository/ProductTypeRepository.php';
require_once './Domain/ProductType.php';
class ProductTypeService {
    private $productTypeRepository;

    public function __construct()
    {
        $this->productTypeRepository = new ProductRepository();
    }

    public function addProductType($name, $taxPercentage)
    {

        $productType = new ProductType($name, $taxPercentage);
        return $this->productTypeRepository->addProductType($productType);
    }

    public function findProductTypeById($id)
    {
        return $this->productTypeRepository->findProductTypeById($id);
    }

    public function getAllProductTypes()
    {
        return $this->productTypeRepository->getAllProductTypes();
    }
}

