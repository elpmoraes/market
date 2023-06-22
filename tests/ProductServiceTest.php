<?php 
use PHPUnit\Framework\TestCase;

require_once './Service/ProductService.php';

class ProductServiceTest extends TestCase
{
    private $productService;

    protected function setUp(): void
    {
        $this->productService = new ProductService();
    }

    public function testAddProduct()
    {
        $name = 'Product Test';
        $price = 10.99;
        $productTypeId = 1;

        $productId = $this->productService->addProduct($name, $price, $productTypeId);

        // Assert that the product was added successfully and an ID is returned
        $this->assertNotNull($productId);
        // Additional assertions can be made to check the specific details of the added product
    }

    public function testFindProductById()
    {
        $productId = 1;

        $product = $this->productService->findProductById($productId);

        // Assert that the product with the given ID is returned
        $this->assertNotNull($product);
        // Additional assertions can be made to check the specific details of the found product
    }

    public function testGetAllProducts()
    {
        $products = $this->productService->getAllProducts();

        // Assert that an array of products is returned
        $this->assertIsArray($products);
        // Additional assertions can be made to check the specific details of the returned products
    }
}
