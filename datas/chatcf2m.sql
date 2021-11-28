-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 28 nov. 2021 à 16:42
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chatcf2m`
--
CREATE DATABASE IF NOT EXISTS `chatcf2m` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chatcf2m`;

-- --------------------------------------------------------

--
-- Structure de la table `chatcf2m_messages`
--

DROP TABLE IF EXISTS `chatcf2m_messages`;
CREATE TABLE IF NOT EXISTS `chatcf2m_messages` (
  `messages_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`messages_id`),
  KEY `fk_messages_users_idx` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatcf2m_users`
--

DROP TABLE IF EXISTS `chatcf2m_users`;
CREATE TABLE IF NOT EXISTS `chatcf2m_users` (
  `users_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `displayedName` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `mailCF2M` varchar(100) NOT NULL,
  `valideAccount` tinyint(4) NOT NULL DEFAULT '0',
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `right` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => normal user\n1 => admin',
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chatcf2m_messages`
--
ALTER TABLE `chatcf2m_messages`
  ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`users_id`) REFERENCES `chatcf2m_users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
