import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Form, Button, Alert, Table } from 'react-bootstrap';

function SalesPage() {
  const [paymentMethod, setPaymentMethod] = useState('');
  const [sales, setSales] = useState([]);
  const [products, setProducts] = useState([]);
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [price, setPrice] = useState(0);
  const [taxAmount, setTaxAmount] = useState(0);
  const [total, setTotal] = useState(0);
  const [email, setEmail] = useState('');
  const [showMessage, setShowMessage] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');

  useEffect(() => {
    const fetchSales = async () => {
      try {
        const response = await axios.get('http://localhost:8080/sales');
        setSales(response.data);
      } catch (error) {
        setErrorMessage('Failed to fetch sales');
      }
    };

    fetchSales();
  }, []);

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

  const handlePaymentMethodChange = (e) => {
    setPaymentMethod(e.target.value);
  };

  const handleProductChange = (e) => {
    const selectedProductId = e.target.value;
    const selectedProduct = products.find((product) => product.id === selectedProductId);

    if (selectedProduct) {
      setSelectedProduct(selectedProduct);
      setPrice(selectedProduct.price);
      let price = parseFloat(selectedProduct.price);
      let tax_percentage = parseFloat(selectedProduct.tax_percentage);
      console.log(selectedProduct);
      calculateTotal(price, tax_percentage);
    }
  };

  const calculateTotal = (price, taxPercentage) => {
    const taxAmount = (price * taxPercentage) / 100;
    const totalAmount = price + taxAmount;
    setTaxAmount(taxAmount);
    setTotal(totalAmount);
  };

  const handleEmailChange = (e) => {
    setEmail(e.target.value);
  };

  const handleCheckout = async () => {
    if (!paymentMethod || !selectedProduct || !email) {
  
      setErrorMessage('Please fill all fields');
      return;
    }
    setErrorMessage(undefined);
    setShowMessage(true);
      try {
        const response = await axios.post('http://localhost:8080/new-sale', {
          paymentMethod,
          productId: selectedProduct.id,
          total: total,
          email,
        });
      } catch (error) {
        setErrorMessage('Failed to process the payment');
      }

  };

  return (
    <div className="container">
            <h3 className="mb-2">Sales List</h3>
            <Table striped bordered hover>
      <thead>
        <tr>
          <th>Customer Email</th>
          <th>Product Name</th>
          <th>Datetime</th>
          <th>Payment Method</th>
          <th>Payment Processed</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        {sales.map((sale) => (
          <tr key={sale.id}>
            <td>{sale.customer_email}</td>
            <td>{sale.product_name}</td>
            <td>{sale.datetime}</td>
            <td>{sale.payment_method}</td>
            <td>{sale.payment_processed === 0 ? 'Yes' : 'No'}</td>
            <td>{sale.total}</td>
          </tr>
        ))}
      </tbody>
    </Table>
    <hr></hr>
      <hr></hr>
      <h3 className="mb-2">New Sale</h3>
      {(showMessage || errorMessage) && (
        <Alert variant={errorMessage ? 'danger' : 'success'}>
          {errorMessage ? errorMessage : `Order Created. Payment instructions have been sent to the email: ${email}`}
        </Alert>
      )}
      <Form>
      <Form.Group>
          <Form.Label>Email</Form.Label>
          <Form.Control
            type="email"
            value={email}
            onChange={handleEmailChange}
            placeholder="email@example.com"
            required
          />
        </Form.Group>
        <Form.Group>
          <Form.Label>Payment Method</Form.Label>
          <Form.Control
            as="select"
            value={paymentMethod}
            onChange={handlePaymentMethodChange}
            required
          >
            <option value="">Select a payment method</option>
            <option value="credit-card">Credit Card</option>
            <option value="paypal">PayPal</option>
          </Form.Control>
        </Form.Group>
        <Form.Group>
          <Form.Label>Select a Product</Form.Label>
          <Form.Control
            as="select"
            value={selectedProduct ? selectedProduct.id : ''}
            onChange={handleProductChange}
            required
          >
            <option value="">Select a Product</option>
            {products.map((product) => (
              <option key={product.id} value={product.id}>
                {product.name}
              </option>
            ))}
          </Form.Control>
        </Form.Group>
        <Form.Group>
          <Form.Label>Price</Form.Label>
          <Form.Control type="text" value={price} readOnly />
        </Form.Group>
        <Form.Group>
  <Form.Label>Tax</Form.Label>
  <Form.Control type="text" value={taxAmount} readOnly />
</Form.Group>
        <Form.Group>
          <Form.Label>Total</Form.Label>
          <Form.Control type="text" value={total} readOnly />
        </Form.Group>

        <Button variant="primary" onClick={handleCheckout}>
          Checkout
        </Button>
      </Form>
    </div>
  );
}

export default SalesPage;
