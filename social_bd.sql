-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Set-2022 às 21:05
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
-- Estrutura da tabela `t_comments`
--

CREATE TABLE `t_comments` (
  `id_comment` double NOT NULL,
  `id_author` double NOT NULL,
  `id_post` double NOT NULL,
  `text_comment` varchar(255) NOT NULL,
  `status_comment` tinyint(2) NOT NULL DEFAULT 0,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_favs`
--

CREATE TABLE `t_favs` (
  `id_fav` double NOT NULL,
  `id_user` double NOT NULL,
  `id_post` double NOT NULL,
  `status_fav` tinyint(2) NOT NULL DEFAULT 0,
  `data_fav` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_follows`
--

CREATE TABLE `t_follows` (
  `id_follow` double NOT NULL,
  `id_follower` double NOT NULL,
  `id_followed` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_media`
--

CREATE TABLE `t_media` (
  `id_media` double NOT NULL,
  `id_post` double NOT NULL,
  `type` enum('vid','pic','lnk','txt') NOT NULL,
  `media` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_posts`
--

CREATE TABLE `t_posts` (
  `id_post` double NOT NULL,
  `id_user` double NOT NULL,
  `text` varchar(255) NOT NULL,
  `status_post` tinyint(2) NOT NULL DEFAULT 0,
  `private` tinyint(2) NOT NULL DEFAULT 0,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_private`
--

CREATE TABLE `t_private` (
  `id_private` double NOT NULL,
  `id_post` double NOT NULL,
  `id_authorized_user` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_profiles`
--

CREATE TABLE `t_profiles` (
  `id_profile` double NOT NULL,
  `id_user` double NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `avatar_pic` varchar(255) NOT NULL,
  `banner_pic` varchar(255) NOT NULL,
  `genre` char(45) NOT NULL,
  `birthdate` date NOT NULL,
  `profile_title` varchar(20) NOT NULL DEFAULT 'Sobre mim',
  `profile_desc` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
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
  `status_user` tinyint(2) NOT NULL DEFAULT 0,
  `regis_date` datetime NOT NULL,
  `type_user` tinyint(2) NOT NULL DEFAULT 0,
  `obs_mod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `t_comments`
--
ALTER TABLE `t_comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_autor` (`id_author`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_favs`
--
ALTER TABLE `t_favs`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `id_favoritador` (`id_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_follows`
--
ALTER TABLE `t_follows`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_follower` (`id_follower`),
  ADD KEY `id_followed` (`id_followed`);

--
-- Índices para tabela `t_media`
--
ALTER TABLE `t_media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_posts`
--
ALTER TABLE `t_posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `t_private`
--
ALTER TABLE `t_private`
  ADD PRIMARY KEY (`id_private`),
  ADD KEY `id_authorized_user` (`id_authorized_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `t_profiles`
--
ALTER TABLE `t_profiles`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `t_comments`
--
ALTER TABLE `t_comments`
  MODIFY `id_comment` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_favs`
--
ALTER TABLE `t_favs`
  MODIFY `id_fav` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_follows`
--
ALTER TABLE `t_follows`
  MODIFY `id_follow` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_media`
--
ALTER TABLE `t_media`
  MODIFY `id_media` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_posts`
--
ALTER TABLE `t_posts`
  MODIFY `id_post` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_private`
--
ALTER TABLE `t_private`
  MODIFY `id_private` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` double NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `t_comments`
--
ALTER TABLE `t_comments`
  ADD CONSTRAINT `t_comments_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_favs`
--
ALTER TABLE `t_favs`
  ADD CONSTRAINT `t_favs_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_follows`
--
ALTER TABLE `t_follows`
  ADD CONSTRAINT `t_follows_ibfk_1` FOREIGN KEY (`id_follower`) REFERENCES `t_users` (`id_user`);

--
-- Limitadores para a tabela `t_media`
--
ALTER TABLE `t_media`
  ADD CONSTRAINT `t_media_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`);

--
-- Limitadores para a tabela `t_posts`
--
ALTER TABLE `t_posts`
  ADD CONSTRAINT `t_posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id_user`);

--
-- Limitadores para a tabela `t_private`
--
ALTER TABLE `t_private`
  ADD CONSTRAINT `t_private_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `t_posts` (`id_post`),
  ADD CONSTRAINT `t_private_ibfk_2` FOREIGN KEY (`id_authorized_user`) REFERENCES `t_users` (`id_user`);

--
-- Limitadores para a tabela `t_profiles`
--
ALTER TABLE `t_profiles`
  ADD CONSTRAINT `t_profiles_ibfk_1` FOREIGN KEY (`id_profile`) REFERENCES `t_users` (`id_user`);

--
-- Limitadores para a tabela `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_follows` (`id_followed`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
