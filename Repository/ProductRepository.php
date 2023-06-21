<?php

require_once 'Connection.php';

class ProductRepository {
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function getAllProducts()
    {
        $query = "SELECT p.*, pt.tax_percentage
                  FROM products p
                  JOIN product_types pt ON p.product_type_id = pt.id";

        $result = $this->connection->executeQuery($query);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        $result->free();

        return $products;
    }

        public function findProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        }else{
            throw new Exception("Product not found");
        }

    }

    public function addProduct(Product $product)
    {
      
        $query = "INSERT INTO products (name, price, product_type_id) VALUES (?, ?, ?)";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->bind_param("sdi", $product->getName(), $product->getPrice(), $product->getProductType());
        $statement->execute();

        return $this->connection->getLastInsertedId();
        $this->connection->executeQuery($query);
        return $this->connection->getLastInsertedId();
    }




}

?>
