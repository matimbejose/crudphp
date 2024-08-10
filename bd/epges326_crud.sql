-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/08/2024 às 21:16
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
-- Banco de dados: `epges326_crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_crud`
--


CREATE TABLE `tbl_crud` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `contato2` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `como_soube_empresa` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Despejando dados para a tabela `tbl_crud`
--

INSERT INTO `tbl_crud` (`id`,`nome`, `whatsapp`, `contato2`, `cpf`, `cep`, `como_soube_empresa`, `created_at`, `updated_at`)
VALUES
('1','João Silva', '(11) 98765-4321', '(11) 91234-5678', '123.456.789-00', '01234-567', 'Familiares', NOW(), NOW()),
('2','Maria Oliveira', '(21) 97654-3210', '(21) 93456-7890', '234.567.890-12', '02345-678', 'Amigos', NOW(), NOW()),
('3','Carlos Santos', '(31) 94567-8901', '(31) 92345-6789', '345.678.901-23', '03456-789', 'Amigos', NOW(), NOW()),
('4','Ana Souza', '(41) 93456-7890', '(41) 91234-5678', '456.789.012-34', '04567-890', 'Amigos', NOW(), NOW()),
('5','Pedro Lima', '(51) 92345-6789', '(51) 93456-7890', '567.890.123-45', '05678-901', 'Familiares', NOW(), NOW());

 --
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_crud`
--
ALTER TABLE `tbl_crud`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_crud`
--
ALTER TABLE `tbl_crud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
