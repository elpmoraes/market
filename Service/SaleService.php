<?php

require_once 'Repository/SaleRepository.php';
require_once './Domain/Sale.php';
require_once './Domain/Product.php';
class SaleService {
    private $saleRepository;

    public function __construct()
    {
        $this->saleRepository = new SaleRepository();
    }

    public function addSale($customerEmail, $paymentMethod, $total, $productId)
    {
        $sale = new Sale($customerEmail, $paymentMethod, $total, $productId);
        return $this->saleRepository->addSale($sale);
    }
    public function getAllSales()
    {
        return $this->saleRepository->getAllSales();
    }
}

?>
