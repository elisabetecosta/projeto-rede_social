-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Out-2022 às 20:32
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
-- Banco de dados: `xata`
--
CREATE DATABASE IF NOT EXISTS `xata` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `xata`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `comment_id` double NOT NULL,
  `author_id` double NOT NULL,
  `post_id` double NOT NULL,
  `text` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favs`
--

CREATE TABLE `favs` (
  `fav_id` double NOT NULL,
  `user_id` double NOT NULL,
  `post_id` double NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `favs`
--

INSERT INTO `favs` (`fav_id`, `user_id`, `post_id`, `status`, `date`) VALUES
(1, 3, 1, 1, '2022-10-05 20:26:41'),
(5, 3, 2, 1, '2022-10-05 20:26:41'),
(6, 3, 3, 1, '2022-10-05 20:26:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `follows`
--

CREATE TABLE `follows` (
  `follow_id` double NOT NULL,
  `follower_id` double NOT NULL,
  `followed_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `follows`
--

INSERT INTO `follows` (`follow_id`, `follower_id`, `followed_id`) VALUES
(3, 5, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `media`
--

CREATE TABLE `media` (
  `media_id` double NOT NULL,
  `post_id` double NOT NULL,
  `type` enum('vid','pic','lnk','txt') NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `media`
--

INSERT INTO `media` (`media_id`, `post_id`, `type`, `content`, `status`) VALUES
(1, 1, 'pic', 'teste.png', 0),
(2, 3, 'pic', 'gato.png', 0),
(3, 3, 'pic', 'ave.png', 0),
(4, 3, 'pic', 'cavalo.png', 0),
(5, 3, 'pic', 'urso.png', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `post_id` double NOT NULL,
  `user_id` double NOT NULL,
  `text` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `private` tinyint(2) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `text`, `status`, `private`, `date`) VALUES
(1, 3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-09-10 18:28:05'),
(2, 3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-09-01 15:29:05'),
(3, 5, 'Então? Está tudo bem por aqui?', 0, 0, '2022-09-05 18:39:05'),
(4, 3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-09-05 18:40:05'),
(5, 5, 'Olá!', 0, 0, '2022-09-07 18:39:05'),
(6, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-09-15 18:39:05'),
(7, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-10-10 22:26:53'),
(8, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-10-10 22:31:20'),
(9, 5, 'Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-10-10 22:31:29'),
(18, 5, 'Isto é um teste.', 0, 0, '2022-10-10 22:45:19'),
(21, 3, 'Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-10-13 21:59:04'),
(22, 5, 'As focas gostam de laranjas?', 0, 0, '2022-10-16 17:00:14'),
(23, 5, 'Não sei se as focas gostam de laranjas.', 0, 0, '2022-10-16 17:00:21'),
(24, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam numquam, aliquid iure placeat molestias temporibus fugiat dolor repellendus quo, soluta exercitationem ratione, ut facere consequatur odit eius ea aliquam possimus.', 0, 0, '2022-10-16 17:26:09'),
(25, 5, 'Pinguins são interessantes mas a nossa foca é infinitamente mais interessante e bela do que o Tux. Quem discorda, não passa de um ignorante.', 0, 0, '2022-10-16 17:29:44'),
(26, 5, 'A Xata é realmente xata?', 0, 0, '2022-10-16 20:29:44'),
(27, 5, 'A Xata não é assim tão chata. Reza a lenda que todas as focas são fofas, gordas e boas nadadoras.', 0, 0, '2022-10-16 22:10:30'),
(36, 3, 'Isto é um teste', 0, 0, '2022-10-17 09:52:21'),
(37, 5, 'Vamos publicar aqui uma frase para perceber afinal de contas se isto está a funcionar ou não e se tem algum limite de caracteres (não tem! Falta as validações...)', 0, 0, '2022-10-17 13:49:27'),
(38, 3, 'TESSSSSSTEEEEE', 0, 0, '2022-10-17 19:25:32'),
(39, 3, 'OLÀ', 0, 0, '2022-10-17 19:30:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `private`
--

CREATE TABLE `private` (
  `private_id` double NOT NULL,
  `post_id` double NOT NULL,
  `authorized_user_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` double NOT NULL,
  `user_id` double NOT NULL,
  `name` varchar(45) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `gender` char(45) NOT NULL,
  `birthdate` date NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT 'Sobre mim',
  `desc` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `profiles`
--

INSERT INTO `profiles` (`profile_id`, `user_id`, `name`, `avatar`, `cover`, `gender`, `birthdate`, `title`, `desc`, `last_updated`) VALUES
(1, 5, 'Ana Paula Almeida', 'avatar.png', 'header_photo.png', '', '1988-08-12', 'Sobre mim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum leo turpis, nec venenatis nunc rutrum rutrum. Fusce non auctor urna. Nulla vulputate, dui non lobortis dignissim, dui lorem consequat tortor.', '2022-09-30 13:35:16'),
(2, 3, 'Rayana', 'avatar.png', 'header_photo.png', 'F', '1988-08-12', 'Sobre mim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum leo turpis, nec venenatis nunc rutrum rutrum. Fusce non auctor urna. Nulla vulputate, dui non lobortis dignissim, dui lorem consequat tortor.', '2022-09-10 18:20:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` double NOT NULL,
  `handle` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `regis_date` datetime NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT 0,
  `mod_obs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `handle`, `email`, `password`, `status`, `regis_date`, `type`, `mod_obs`) VALUES
(3, 'rayana', 'rayanawolfer@gmail.com', '123456789', 0, '2022-09-10 18:17:14', 0, ''),
(5, 'ana', 'anapaula.aka@gmail.com', '123456789', 0, '2022-09-30 13:35:16', 0, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `id_autor` (`author_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Índices para tabela `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `id_favoritador` (`user_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Índices para tabela `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `id_follower` (`follower_id`),
  ADD KEY `id_followed` (`followed_id`);

--
-- Índices para tabela `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Índices para tabela `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`private_id`),
  ADD KEY `id_authorized_user` (`authorized_user_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Índices para tabela `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favs`
--
ALTER TABLE `favs`
  MODIFY `fav_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `media`
--
ALTER TABLE `media`
  MODIFY `media_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `private`
--
ALTER TABLE `private`
  MODIFY `private_id` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Limitadores para a tabela `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Limitadores para a tabela `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `private`
--
ALTER TABLE `private`
  ADD CONSTRAINT `private_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `private_ibfk_2` FOREIGN KEY (`authorized_user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
