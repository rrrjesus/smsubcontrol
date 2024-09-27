-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/09/2024 às 05:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `smsubcontrol`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `brand_id` int(11) UNSIGNED NOT NULL,
  `product_name` text NOT NULL,
  `type_part_number` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'actived' COMMENT 'actived, disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_created` varchar(7) NOT NULL,
  `login_updated` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `brand_id`, `product_name`, `type_part_number`, `description`, `status`, `created_at`, `updated_at`, `login_created`, `login_updated`) VALUES
(1, 1, 'Tablet Galaxy Tab A7', 'IMEI', 'Samsung Galaxy Tab A7 Android com carregador e cabo usb tipo c.', 'actived', '2024-08-30 19:20:52', '2024-09-27 02:09:34', '', 'd788796'),
(2, 1, 'Tablet Galaxy Tab A8', 'IMEI', 'Samsung Galaxy Tab A8 Android', 'actived', '2024-08-30 19:20:52', '2024-09-27 02:09:37', '', 'd788796'),
(3, 3, 'Chip de Telefonia', 'CHIP', 'Chip VIVO de telefonia para utiliza&ccedil;&atilde;o em Tablets', 'actived', '2024-09-09 19:21:14', '2024-09-27 02:09:40', 'd788796', 'd788796'),
(4, 2, 'RP4B', 'NS', 'Impressora m&oacute;vel de recibos e etiquetas.', 'actived', '2024-09-13 12:12:03', '2024-09-27 01:10:18', 'd788796', 'd788796'),
(5, 1, 'A9 TESTE', 'IMEI', 'TABLET IMAGINARIO', 'actived', '2024-09-26 21:58:14', '2024-09-27 01:10:27', 'x033455', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pat_brand` (`brand_id`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `pat_marca_modelo` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
