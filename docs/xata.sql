-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 10:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xata`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `fav_id` double NOT NULL,
  `user_id` double NOT NULL,
  `post_id` double NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favs`
--

INSERT INTO `favs` (`fav_id`, `user_id`, `post_id`, `status`, `date`) VALUES
(1, 3, 1, 1, '2022-10-05 20:26:41'),
(5, 3, 2, 1, '2022-10-05 20:26:41'),
(6, 3, 3, 1, '2022-10-05 20:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follow_id` double NOT NULL,
  `follower_id` double NOT NULL,
  `followed_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follow_id`, `follower_id`, `followed_id`) VALUES
(3, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` double NOT NULL,
  `post_id` double NOT NULL,
  `type` enum('vid','pic','lnk','txt') NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `post_id`, `type`, `content`, `status`) VALUES
(1, 1, 'pic', 'teste.png', 0),
(2, 3, 'pic', 'gato.png', 0),
(3, 3, 'pic', 'ave.png', 0),
(4, 3, 'pic', 'cavalo.png', 0),
(5, 3, 'pic', 'urso.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
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
-- Dumping data for table `posts`
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
(39, 3, 'OLÀ', 0, 0, '2022-10-17 19:30:20'),
(40, 6, 'teste1', 0, 0, '2022-11-02 21:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `private`
--

CREATE TABLE `private` (
  `private_id` double NOT NULL,
  `post_id` double NOT NULL,
  `authorized_user_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
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
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `user_id`, `name`, `avatar`, `cover`, `gender`, `birthdate`, `title`, `desc`, `last_updated`) VALUES
(0, 6, 'Elisabete Costa', '', '', '', '1994-03-13', 'Sobre mim', '', '2022-11-02 21:14:17'),
(1, 5, 'Ana Paula Almeida', 'avatar.png', 'header_photo.png', '', '1988-08-12', 'Sobre mim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum leo turpis, nec venenatis nunc rutrum rutrum. Fusce non auctor urna. Nulla vulputate, dui non lobortis dignissim, dui lorem consequat tortor.', '2022-09-30 13:35:16'),
(2, 3, 'Rayana', 'avatar.png', 'header_photo.png', 'F', '1988-08-12', 'Sobre mim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum leo turpis, nec venenatis nunc rutrum rutrum. Fusce non auctor urna. Nulla vulputate, dui non lobortis dignissim, dui lorem consequat tortor.', '2022-09-10 18:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `handle`, `email`, `password`, `status`, `regis_date`, `type`, `mod_obs`) VALUES
(3, 'rayana', 'rayanawolfer@gmail.com', '123456789', 0, '2022-09-10 18:17:14', 0, ''),
(5, 'ana', 'anapaula.aka@gmail.com', '123456789', 0, '2022-09-30 13:35:16', 0, ''),
(6, 'hime94', 'elisaapps@gmail.com', '123456789', 0, '2022-11-02 21:14:17', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `id_autor` (`author_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `id_favoritador` (`user_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `id_follower` (`follower_id`),
  ADD KEY `id_followed` (`followed_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`private_id`),
  ADD KEY `id_authorized_user` (`authorized_user_id`),
  ADD KEY `id_post` (`post_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favs`
--
ALTER TABLE `favs`
  MODIFY `fav_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `private`
--
ALTER TABLE `private`
  MODIFY `private_id` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `private`
--
ALTER TABLE `private`
  ADD CONSTRAINT `private_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `private_ibfk_2` FOREIGN KEY (`authorized_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
