import React from 'react';
import { BrowserRouter, Route, Link, Switch } from 'react-router-dom';
import ProductPage from './ProductPage';
import SalesPage from './SalesPage';
import ProductTypePage from './ProductTypePage';
import { Nav } from 'react-bootstrap';

function App() {
  return (
    <>

       <BrowserRouter>
       <div>
      <Nav className="justify-content-center" variant="tabs">
        <Nav.Item>
          <Nav.Link href="/" className="nav-link">Home</Nav.Link>
        </Nav.Item>
        <Nav.Item>
          <Nav.Link href="/sales" className="nav-link">Sales</Nav.Link>
        </Nav.Item>
        <Nav.Item>
          <Nav.Link href="/product-types" className="nav-link">Product Types</Nav.Link>
        </Nav.Item>
        <Nav.Item>
          <Nav.Link href="/products" className="nav-link">Products</Nav.Link>
        </Nav.Item>
      </Nav>
    </div>
    <Route component = { SalesPage }  path="/sales" exact/>
    <Route component = { ProductTypePage }  path="/product-types" />
      <Route component = { ProductPage }  path="/products" />
       </BrowserRouter>


   </>
  );
}

export default App;
