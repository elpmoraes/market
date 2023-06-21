<?php

require_once 'Service/ProductService.php';

class ProductController {
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function addProduct()
    {
        $jsonData = file_get_contents('php://input');

        if (!empty($jsonData)) {
            $productData = json_decode($jsonData, true);
            
            $name = $productData['name'];
            $price = $productData['price'];
            $productTypeId = $productData['productType'];

            $productId = $this->productService->addProduct($name, $price, $productTypeId);

            $response = [
                'success' => true,
                'message' => 'Product added successfully',
                'product_id' => $productId
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Invalid request body'
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function getProducts()
    {
        $products = $this->productService->getAllProducts();

        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function showProduct($id)
    {
        try {
            $productType = $this->productService->findProductById((int)$id);
            
            header('Content-Type: application/json');
            echo json_encode($productType);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
