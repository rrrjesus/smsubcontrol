-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/10/2024 às 06:34
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
-- Estrutura para tabela `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) UNSIGNED NOT NULL,
  `sei_process` varchar(25) NOT NULL,
  `contract_name` text NOT NULL,
  `manager_id` int(11) UNSIGNED NOT NULL,
  `inspector_id` int(11) UNSIGNED NOT NULL,
  `deputy_inspector_id` int(11) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'actived' COMMENT 'actived, disabled',
  `description` text DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `login_created` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_updated` varchar(7) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contracts`
--

INSERT INTO `contracts` (`id`, `sei_process`, `contract_name`, `manager_id`, `inspector_id`, `deputy_inspector_id`, `status`, `description`, `observations`, `login_created`, `created_at`, `login_updated`, `updated_at`) VALUES
(1, '6012.2019/0005605-6', 'SIMPRESS - 2021', 515, 3, 2, 'actived', 'Loca&ccedil;&atilde;o de 690 Tablets (A7/A8) e Impressoras HoneyWell', 'Vencimento:', 'd788796', '2024-10-01 17:18:33', 'd788796', '2024-10-03 02:58:02'),
(2, '6012.2024/0008063-0', 'SIMPRESS - 2024', 515, 3, 3, 'actived', 'Loca&ccedil;&atilde;o de 690 Tablets A9 e Impressoras HoneyWell', 'Vencimento: 29/08/2025', 'd788796', '2024-10-01 17:23:23', 'd788796', '2024-10-03 03:08:53'),
(3, '6012.2024/0012696-7', 'TELEF&Ocirc;NICA VIVO', 515, 3, 2, 'actived', 'Loca&ccedil;&atilde;o de 690 CHIPS VIVO', 'Vencimento : 02/07/2025', 'd788796', '2024-10-01 17:23:49', 'd788796', '2024-10-03 03:09:29');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pat_user_manager` (`manager_id`) USING BTREE,
  ADD KEY `pat_user_inspector` (`inspector_id`) USING BTREE,
  ADD KEY `pat_user_deputy_inspector` (`deputy_inspector_id`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `pat_user_deputy_inspector` FOREIGN KEY (`deputy_inspector_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pat_user_inspector` FOREIGN KEY (`inspector_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pat_user_manager` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
