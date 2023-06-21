import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Form, Button, Alert, Table } from 'react-bootstrap';

function ProductTypePage() {
  const [name, setName] = useState('');
  const [taxPercentage, setTaxPercentage] = useState(0);
  const [productTypes, setProductTypes] = useState([]);
  const [showMessage, setShowMessage] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');

  
  useEffect(() => {
    const fetchProductTypes = async () => {
      try {
        const response = await axios.get('http://localhost:8080/product-types');
        setProductTypes(response.data);
      } catch (error) {
        setErrorMessage('Failed to fetch product types');
      }
    };

    fetchProductTypes();
  }, []);

  const handleNameChange = (e) => {
    setName(e.target.value);
  };

  const handleTaxPercentageChange = (e) => {
    setTaxPercentage(e.target.value);
  };


  const handleAddProduct = async () => {
    if (!name || !taxPercentage) {
      setErrorMessage('Please fill all fields');
      return;
    }

    try {
      await axios.post('http://localhost:8080/add-product-types', {
        name,
        taxPercentage,
      });

      setName('');
      setTaxPercentage(0);
      setErrorMessage('');
      setShowMessage(true);
    } catch (error) {
      setErrorMessage('Failed to add product type');
    }
  };

  return (
    <div className="container">
      <h3 className="mb-2">Product Type List</h3>
      <Table striped bordered hover>
      <thead>
        <tr>
          <th>Name</th>
          <th>Tax Percentage</th>
        </tr>
      </thead>
      <tbody>
        {productTypes.map((productType) => (
          <tr key={productType.id}>
            <td>{productType.name}</td>
            <td>{productType.tax_percentage}</td>

          </tr>
        ))}
      </tbody>
      </Table>
      <hr></hr>
      <hr></hr>
      <h3 className="mb-2">Add Product Type</h3>
      {(showMessage || errorMessage) && (
        <Alert variant={errorMessage ? 'danger' : 'success'}>
          {errorMessage ? errorMessage : 'Product Type added successfully'}
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
          <Form.Label>Tax Percentage</Form.Label>
          <Form.Control
            type="number"
            value={taxPercentage}
            onChange={handleTaxPercentageChange}
            placeholder="Enter tax percentage"
            required
          />
        </Form.Group>
        <Button variant="primary" onClick={handleAddProduct}>
          Add Product
        </Button>
      </Form>
    </div>
  );
}

export default ProductTypePage;
