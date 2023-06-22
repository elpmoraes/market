SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `market`
--
CREATE DATABASE IF NOT EXISTS `market` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `market`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_type_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_type_id`) VALUES
(2, 'Car', 9.99, 1),
(3, 'Action Figure', 3.00, 1),
(4, 'Chair', 25.00, 2),
(5, 'Table', 50.00, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_percentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `tax_percentage`) VALUES
(1, 'Toys', 100.00),
(2, 'Furniture', 3.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_method` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_processed` tinyint(1) DEFAULT '0',
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `sales`
--

INSERT INTO `sales` (`id`, `customer_email`, `datetime`, `payment_method`, `total`, `payment_processed`, `product_id`) VALUES
(1, 'felipe@example.com', '2023-06-20 23:41:00', 'credit-card', 6.00, 0, 3),
(2, 'felipe@example.com', '2023-06-20 23:41:23', 'paypal', 6.00, 0, 3),
(3, 'test@test.com', '2023-06-21 21:51:37', 'credit-card', 19.98, 0, 2),
(4, 'felipe@example.com', '2023-06-21 21:51:46', 'credit-card', 19.98, 0, 2),
(5, 'felipe@example.com', '2023-06-21 21:53:00', 'credit-card', 19.98, 0, 2),
(6, 'felipe@example.com', '2023-06-21 21:53:08', 'credit-card', 19.98, 0, 2),
(7, 'felipe@example.com', '2023-06-21 22:54:23', 'paypal', 19.98, 0, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Índices de tabela `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`);

--
-- Restrições para tabelas `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
