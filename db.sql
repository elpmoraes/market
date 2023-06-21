CREATE DATABASE IF NOT EXISTS market;
USE market;

-- Table: product_types
CREATE TABLE IF NOT EXISTS product_types (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  tax_percentage DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Table: products
CREATE TABLE IF NOT EXISTS products (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  product_type_id INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (product_type_id) REFERENCES product_types (id)
) ENGINE=InnoDB;

-- Table: sales
CREATE TABLE sales (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    customer_email VARCHAR(50) NOT NULL,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    payment_method VARCHAR(50) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    payment_processed boolean DEFAULT false,
    product_id INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB;
