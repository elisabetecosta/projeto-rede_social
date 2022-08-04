-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Ago-2022 às 20:26
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29


/*
VERSÃO 1.0
Ficheiro: social_bd.sql
URL: https://github.com/elisabetecosta/projeto-rede_social/blob/main/social_bd.sql
Data: 04/08/2022


A versão primária da base de dados possui apenas três tabelas: t_posts, t_comentarios e t_users

CONSIDERAÇÕES:
1) Uma rede social poderá ter milhões de utilizadores, posts e comentários, razão pela qual o ID de cada uma destas tabelas está definido como DOUBLE ao invés de INT.
2) Todos os campos estão definidos como NOT NULL, inclusive o das fotos.

==================================================
                 TABELA   t_posts
==================================================

    id_user       DOUBLE(sem limite)  PK  AI   NOT NULL
                  Uma rede social poderá ter milhões de utilizadores, razão pela qual o ID está definido como DOUBLE ao invés de INT.
                
    nick          VARCHAR(15)  NOT NULL
                  Este campo diz respeito ao nickname do utilizador que está visível para todos verem
                
    email         VARCHAR(50)  NOT NULL
                  Endereço de email usado pel utilizador para se registar na rede social, não será visivel publicamente
                
    password      VARCHAR(255)  NOT NULL
                  Tem tamanho 255 porque será encriptada com uma função de encriptação em PHP
                
    foto_perfil   VARCHAR(300)  NOT NULL 
                  Aqui estará escrito o directório onde está a ser guardada a imagem (ex.: users/pedro/imagens/perfil.png)
                  É NOT NULL porque se o utilizador não colocar uma imagem personalizada, o valor predefinido será uma imagem default (ex.: users/foto_perfil_default.png)
                
    foto_capa     VARCHAR(300)  NOT NULL 
                  Aqui estará escrito o directório onde está a ser guardada a imagem da capa (ex.: users/pedro/imagens/capa.png)
                  É NOT NULL porque se o utilizador não colocar uma imagem personalizada, o valor predefinido será uma imagem default (ex.: users/img_capa_default.png)
                  
    apagado_u	    INT(11)  NOT NULL
                  0 = Valor por defeito, indica que o utilizador está activo
                  1 = Significa que o utilizador eliminou a própria conta
                  2 = Banido da rede social pelo administrador

*/



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
  `texto_comment` text NOT NULL,
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
  `foto_p` double NOT NULL,
  `apagado_p` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_users`
--

CREATE TABLE `t_users` (
  `id_user` double NOT NULL,
  `nome` varchar(15) NOT NULL,
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
