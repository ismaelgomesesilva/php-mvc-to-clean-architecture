-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jan-2020 às 20:52
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `store`
--
DROP DATABASE IF EXISTS `store`;
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `store`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Telephony', 'Telephony products'),
(2, 'Computing', 'Computing products'),
(3, ' Home appliances', ' Home appliances products'),
(4, 'Furniture', 'Furniture products'),
(5, 'Cleaning', 'Cleaning products');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` longtext NOT NULL,
  `price` float NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `category_id`) VALUES
(3, 'iPhone 7 Apple 32GB', ' iPhone 7 Apple 32GB 4.7 ', '', 3199, 1),
(5, 'Notebook Lenovo Ideapad 320', ' Lenovo Core i3-6006U 4GB 1TB Notebook Full HD 15.6 ”Screen Windows 10 Ideapad 320', '', 1799, 2),
(7, ' Office Chair Peter', ' Peter Office Chair w / Nylon Backrest and Relax Function - Black - Imported', '', 229, 4);

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `email`) VALUES
(1, 'Aiden Pierce', 'aiden.pierce@ctos.net'),
(2, 'Marcus Holloway', 'mholloway@dedsec.com'),
(3, 'John Doe', 'jdoe@symplicity.com'),
(4, 'Elon Musk', 'elon.musk@tesla.com'),
(5, 'Bill Gates', 'mrgates@microsoft.com'),
(6, 'Randy White', 'rwhite@armyspy.com'),
(7, 'Emma Eckert', 'emma@dummycompany.net'),
(8, 'Linda Smith', 'lsmith@imtheboss.net'),
(9, 'John Preston', 'johnpreston@equilibrium.com'),
(10, 'Evey Hammond', 'evey@vforvendetta.net'),
(11, 'Adam Sutler', 'chanceler@britishgovernment.gov.uk'),
(12, 'Eric Finch', 'mrfinch@londonpolice.gov.uk'),
(13, 'James Bond', 'bond@mi6.gov.uk'),
(14, 'John McClane', 'john.mcclane@nypd.gov'),
(15, 'Thomas Anderson', 'tanderson@matrix.net');


-- --------------------------------------------------------

--
-- Estrutura da tabela `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `purchase_amount` decimal(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `transaction`
--

INSERT INTO `transaction` (`id`, `purchase_amount`, `transaction_date`, `customer_id`) VALUES
(1, '5.00', '2022-11-10 14:24:33', 1),
(3, '15.00', '2022-10-11 01:05:00', 3),
(4, '1500.00', '2022-10-11 01:06:45', 3),
(5, '5.60', '2022-10-11 04:06:49', 4),
(6, '1.50', '2022-10-11 04:06:59', 4),
(7, '50.00', '2022-10-11 04:07:07', 4),
(10, '6.50', '2022-10-11 06:12:18', 1),
(11, '6500.00', '2022-10-11 06:16:28', 5),
(12, '300.00', '2022-10-11 06:16:28', 5),
(13, '2500.00', '2022-10-11 06:16:28', 5),
(14, '40.00', '2022-10-11 06:16:28', 5),
(15, '42.90', '2022-10-11 06:16:28', 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`customer_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--
--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
