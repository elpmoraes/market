<?php

require_once 'Repository/ProductRepository.php';
require_once './Domain/Product.php';
require_once './Domain/ProductType.php';
class ProductService {
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function addProduct($name, $price, $productTypeId)
    {
        $productType = new ProductType(null,null);
        $productType->setId($productTypeId);
        $product = new Product($name, $price, $productType);
        return $this->productRepository->addProduct($product);
    }

    public function findProductById($id)
    {
        return $this->productRepository->findProductById($id);
    }
    
    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }
}

?>
