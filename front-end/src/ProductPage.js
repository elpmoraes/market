import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Form, Button, Alert, Table } from 'react-bootstrap';

function ProductPage() {
  const [name, setName] = useState('');
  const [price, setPrice] = useState(0);
  const [productTypes, setProductTypes] = useState([]);
  const [selectedProductType, setSelectedProductType] = useState('');
  const [products, setProducts] = useState([]);
  const [showMessage, setShowMessage] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const response = await axios.get('http://localhost:8080/products');
        setProducts(response.data);
      } catch (error) {
        setErrorMessage('Failed to fetch products');
      }
    };

    fetchProducts();
  }, []);
  
  useEffect(() => {
    const fetchProductTypes = async () => {
      try {
        const response = await axios.get('http://localhost:8080/product-types');
        setProductTypes(response.data);
      } catch (error) {
        setErrorMessage('Failed to fetch products');
      }
    };

    fetchProductTypes();
  }, []);

  const handleNameChange = (e) => {
    setName(e.target.value);
  };

  const handlePriceChange = (e) => {
    setPrice(e.target.value);
  };

  const handleProductTypeChange = (e) => {
    setSelectedProductType(e.target.value);
  };

  const handleAddProduct = async () => {
    if (!name || !price || !selectedProductType) {
      setErrorMessage('Please fill all fields');
      return;
    }

    try {
      await axios.post('http://localhost:8080/add-product', {
        name,
        price,
        productType: selectedProductType,
      });

      setName('');
      setPrice(0);
      setSelectedProductType('');
      setErrorMessage(undefined);
      setShowMessage(true);
    } catch (error) {
      setErrorMessage('Failed to add product');
    }
  };

  return (
    
    <div className="container">
            <h3 className="mb-2">Product List</h3>
            <Table striped bordered hover>
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        {products.map((product) => (
          <tr key={product.id}>
            <td>{product.name}</td>
            <td>{product.price}</td>

          </tr>
        ))}
      </tbody>
      </Table>
      <hr></hr>
      <hr></hr>

      <h3 className="mb-2">Add Product</h3>
      {(showMessage || errorMessage) && (
        <Alert variant={errorMessage ? 'danger' : 'success'}>
          {errorMessage ? errorMessage : `Product added successfully`}
        </Alert>
      )}
      <Form>
        <Form.Group>
          <Form.Label>Name</Form.Label>
          <Form.Control
            type="text"
            value={name}
            onChange={handleNameChange}
            placeholder="Enter name"
            required
          />
        </Form.Group>
        <Form.Group>
          <Form.Label>Price</Form.Label>
          <Form.Control
            type="number"
            value={price}
            onChange={handlePriceChange}
            placeholder="Enter price"
            required
          />
        </Form.Group>
        <Form.Group>
          <Form.Label>Product Type</Form.Label>
          <Form.Control
            as="select"
            value={selectedProductType}
            onChange={handleProductTypeChange}
            required
          >
            <option value="">Select a product type</option>
            {productTypes.map((productType) => (
              <option key={productType.id} value={productType.id}>
                {productType.name}
              </option>
            ))}
          </Form.Control>
        </Form.Group>
        <Button variant="primary" onClick={handleAddProduct}>
          Add Product
        </Button>
      </Form>
    </div>
  );
}

export default ProductPage;
