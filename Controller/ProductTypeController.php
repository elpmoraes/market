<?php

require_once 'Service/ProductTypeService.php';

class ProductTypeController {
    private $productTypeService;

    public function __construct()
    {
        $this->productTypeService = new ProductTypeService();
    }

    public function addProductTypes()
    {
        $jsonData = file_get_contents('php://input');

        if (!empty($jsonData)) {
            $productData = json_decode($jsonData, true);
            
            $name = $productData['name'];
            $taxPercentage = $productData['taxPercentage'];

            $productId = $this->productTypeService->addProductType($name, $taxPercentage);

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

    public function getProductTypes()
    {
        $productTypes = $this->productTypeService->getAllProductTypes();

        header('Content-Type: application/json');
        echo json_encode($productTypes);
    }

    public function showProductType($id)
    {
        try {
            $productType = $this->productTypeService->findProductTypeById((int)$id);
            
            // Return a JSON response with the product type
            header('Content-Type: application/json');
            echo json_encode($productType);
        } catch (Exception $e) {
            // Handle any exceptions and return an error response
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}