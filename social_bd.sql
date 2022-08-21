-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Ago-2022 às 00:02
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
-- Estrutura da tabela `t_com1`
--

CREATE TABLE `t_com1` (
  `id_com1` double NOT NULL,
  `id_autor` double NOT NULL,
  `id_post` double NOT NULL,
  `texto_com1` varchar(255) NOT NULL,
  `estado_com1` int(11) NOT NULL DEFAULT 0,
  `data_com1` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_com2`
--

CREATE TABLE `t_com2` (
  `id_com2` double NOT NULL,
  `id_autor` double NOT NULL,
  `id_com1` double NOT NULL,
  `texto_com2` varchar(255) NOT NULL,
  `estado_com2` int(11) NOT NULL DEFAULT 0,
  `data_com2` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_favs`
--

CREATE TABLE `t_favs` (
  `id_fav` double NOT NULL,
  `id_favoritador` double NOT NULL,
  `id_post` double NOT NULL,
  `estado_fav` tinyint(1) NOT NULL DEFAULT 0,
  `data_fav` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_fotos`
--

CREATE TABLE `t_fotos` (
  `id_foto` double NOT NULL,
  `id_post` double NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `estado_img` int(11) NOT NULL DEFAULT 0,
  `data_pub` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_perfis`
--

CREATE TABLE `t_perfis` (
  `id_perfil` double NOT NULL,
  `id_user` double NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `avatar_img` varchar(255) NOT NULL,
  `capa_img` varchar(255) NOT NULL,
  `genero` char(45) NOT NULL,
  `data_nasc` date NOT NULL,
  `perfil_desc` varchar(255) NOT NULL,
  `data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_posts`
--

CREATE TABLE `t_posts` (
  `id_post` double NOT NULL,
  `id_user` double NOT NULL,
  `texto` varchar(255) NOT NULL,
  `id_foto` double DEFAULT NULL,
  `estado_p` int(11) NOT NULL DEFAULT 0,
  `privado` int(11) NOT NULL DEFAULT 0,
  `data_pub` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_privado`
--

CREATE TABLE `t_privado` (
  `id_privado` double NOT NULL,
  `id_post` double NOT NULL,
  `id_user_autorizado` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_users`
--

CREATE TABLE `t_users` (
  `id_user` double NOT NULL,
  `handle_user` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado_user` int(11) NOT NULL DEFAULT 0,
  `data_regis` datetime NOT NULL,
  `tipo_user` int(11) NOT NULL DEFAULT 0,
  `obs_mod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `t_com1`
--
ALTER TABLE `t_com1`
  ADD PRIMARY KEY (`id_com1`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_com2`
--
ALTER TABLE `t_com2`
  ADD PRIMARY KEY (`id_com2`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_com1` (`id_com1`);

--
-- Índices para tabela `t_favs`
--
ALTER TABLE `t_favs`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `id_favoritador` (`id_favoritador`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_fotos`
--
ALTER TABLE `t_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_perfis`
--
ALTER TABLE `t_perfis`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `t_posts`
--
ALTER TABLE `t_posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_foto` (`id_foto`);

--
-- Índices para tabela `t_privado`
--
ALTER TABLE `t_privado`
  ADD PRIMARY KEY (`id_privado`);

--
-- Índices para tabela `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `t_com1`
--
ALTER TABLE `t_com1`
  MODIFY `id_com1` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_com2`
--
ALTER TABLE `t_com2`
  MODIFY `id_com2` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_favs`
--
ALTER TABLE `t_favs`
  MODIFY `id_fav` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_fotos`
--
ALTER TABLE `t_fotos`
  MODIFY `id_foto` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_posts`
--
ALTER TABLE `t_posts`
  MODIFY `id_post` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_privado`
--
ALTER TABLE `t_privado`
  MODIFY `id_privado` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` double NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `t_com1`
--
ALTER TABLE `t_com1`
  ADD CONSTRAINT `t_com1_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_com2`
--
ALTER TABLE `t_com2`
  ADD CONSTRAINT `t_com2_ibfk_1` FOREIGN KEY (`id_com1`) REFERENCES `t_com1` (`id_com1`);

--
-- Limitadores para a tabela `t_favs`
--
ALTER TABLE `t_favs`
  ADD CONSTRAINT `t_favs_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_fotos`
--
ALTER TABLE `t_fotos`
  ADD CONSTRAINT `t_fotos_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_perfis`
--
ALTER TABLE `t_perfis`
  ADD CONSTRAINT `t_perfis_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `t_users` (`id_user`);

--
-- Limitadores para a tabela `t_posts`
--
ALTER TABLE `t_posts`
  ADD CONSTRAINT `t_posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
