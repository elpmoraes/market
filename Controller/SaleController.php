<?php

require_once 'Service/SaleService.php';

class SaleController {
    private $saleService;

    public function __construct()
    {
        $this->saleService = new SaleService();
    }
    public function getSales()
    {
        $sales = $this->saleService->getAllSales();

        header('Content-Type: application/json');
        echo json_encode($sales);
    }
    public function newSale()
    {
        $jsonData = file_get_contents('php://input');

        if (!empty($jsonData)) {
            $productData = json_decode($jsonData, true);
            
            $customerEmail = $productData['email'];
            $paymentMethod = $productData['paymentMethod'];
            $total = $productData['total'];
            $productId = $productData['productId'];

            $productId = $this->saleService->addSale($customerEmail, $paymentMethod, (double)$total, (int)$productId);

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

    

   
}

?>
