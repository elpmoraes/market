<?php

require_once 'Connection.php';
require_once './Domain/ProductType.php';
class ProductRepository {
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function findProductTypeById($id)
    {
        $query = "SELECT * FROM product_types WHERE id = ?";

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        }else{
            throw new Exception("Product type not found");
        }

    }

    public function getAllProductTypes()
    {
        $query = "SELECT pt.*
                  FROM product_types pt";

        $result = $this->connection->executeQuery($query);

        $productTypes = [];
        while ($row = $result->fetch_assoc()) {
            $productTypes[] = $row;
        }

        $result->free();

        return $productTypes;
    }

    public function addProductType(ProductType $productType)
    {
      
        $query = "INSERT INTO product_types (name, tax_percentage) VALUES (?, ?)";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->bind_param("sd", $productType->getName(), $productType->getTaxPercentage());
        $statement->execute();

        return $this->connection->getLastInsertedId();
        $this->connection->executeQuery($query);
        return $this->connection->getLastInsertedId();
    }

}

?>
