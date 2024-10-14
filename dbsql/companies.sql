-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/10/2024 às 04:37
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
-- Estrutura para tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_name` text NOT NULL,
  `description` text NOT NULL,
  `site` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'actived' COMMENT 'actived, disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_created` varchar(7) NOT NULL,
  `login_updated` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `description`, `site`, `status`, `created_at`, `updated_at`, `login_created`, `login_updated`) VALUES
(1, 'Simpress', 'Empresa especialista em outsourcing de equipamentos de TI.', 'https://simpress.com.br/', 'actived', '2024-10-14 02:34:15', '2024-10-14 02:34:15', 'd788796', 'd788796');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
