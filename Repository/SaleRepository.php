<?php

require_once 'Connection.php';

class SaleRepository {
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function addSale(Sale $sale)
    {
      
        $query = "INSERT INTO sales (customer_email, payment_method, total, product_id) VALUES (?, ?, ?, ?)";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->bind_param("ssss", $sale->getCustomerEmail(), $sale->getPaymentMethod(), $sale->getTotal(), $sale->getProductId());
        $statement->execute();
        return $this->connection->getLastInsertedId();
    }

    public function getAllSales()
    {
        $query = "SELECT s.*, p.name as product_name
                     FROM sales s
                    inner join products p on s.product_id = p.id ";

        $result = $this->connection->executeQuery($query);

        $sales = [];
        while ($row = $result->fetch_assoc()) {
            $sales[] = $row;
        }

        $result->free();

        return $sales;
    }


}

?>
