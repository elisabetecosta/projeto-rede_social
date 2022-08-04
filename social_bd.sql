-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Ago-2022 às 22:06
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `social_bd`
--
CREATE DATABASE IF NOT EXISTS `social_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `social_bd`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_comentarios`
--

CREATE TABLE `t_comentarios` (
  `id_comment` double NOT NULL,
  `id_user` double NOT NULL,
  `id_post` double NOT NULL,
  `texto_comment` varchar(255) NOT NULL,
  `apagado_c` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_posts`
--

CREATE TABLE `t_posts` (
  `id_post` double NOT NULL,
  `id_user` double NOT NULL,
  `texto` varchar(255) NOT NULL,
  `foto_p` varchar(300) DEFAULT NULL,
  `apagado_p` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_users`
--

CREATE TABLE `t_users` (
  `id_user` double NOT NULL,
  `nick` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_nasc` varchar(10) NOT NULL,
  `foto_perfil` varchar(300) NOT NULL,
  `foto_capa` varchar(300) NOT NULL,
  `apagado_u` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `t_comentarios`
--
ALTER TABLE `t_comentarios`
  ADD PRIMARY KEY (`id_comment`);

--
-- Índices para tabela `t_posts`
--
ALTER TABLE `t_posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Índices para tabela `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `t_comentarios`
--
ALTER TABLE `t_comentarios`
  MODIFY `id_comment` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_posts`
--
ALTER TABLE `t_posts`
  MODIFY `id_post` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` double NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
