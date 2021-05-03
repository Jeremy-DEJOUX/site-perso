-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 fév. 2021 à 11:43
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `memory`
--

-- --------------------------------------------------------

--
-- Structure de la table `easy`
--

DROP TABLE IF EXISTS `easy`;
CREATE TABLE IF NOT EXISTS `easy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `scores` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `easy`
--

INSERT INTO `easy` (`id`, `id_user`, `scores`) VALUES
(5, 4, 30);

-- --------------------------------------------------------

--
-- Structure de la table `hard`
--

DROP TABLE IF EXISTS `hard`;
CREATE TABLE IF NOT EXISTS `hard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `scores` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hard` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `hard`
--

INSERT INTO `hard` (`id`, `id_user`, `scores`) VALUES
(3, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `normal`
--

DROP TABLE IF EXISTS `normal`;
CREATE TABLE IF NOT EXISTS `normal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `scores` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `normal` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `perso`
--

DROP TABLE IF EXISTS `perso`;
CREATE TABLE IF NOT EXISTS `perso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `scores` int(11) NOT NULL,
  `nb_pairs` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `perso` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `perso`
--

INSERT INTO `perso` (`id`, `id_user`, `scores`, `nb_pairs`) VALUES
(3, 4, 72, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(4, 'Guillaume', '$2y$10$oBdLaJj8f55yxErzhm2e8.ZUH7gtCQogtFnU7cpi7q8JLcqRlnja6'),
(5, 'Jeremy', '$2y$10$/WA3KdtHf4eqLQWDwAVm9ucpwmELA2DX8PQMmu3yGuMYsabnHh9km'),
(6, 'Fabien', '$2y$10$GoF9beyAz6A4fR0r2oxfBuJC46rXLT9ruvz35w/R0TPktJZhQBRnu'),
(7, 'johndoe', '$2y$10$Ub5m7zgMICGVvI6pW2Q3Gew.T8jercRu2V6LFqRdJ4IV2xLGF8MIW');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `easy`
--
ALTER TABLE `easy`
  ADD CONSTRAINT `easy_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `hard`
--
ALTER TABLE `hard`
  ADD CONSTRAINT `hard` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `normal`
--
ALTER TABLE `normal`
  ADD CONSTRAINT `normal` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `perso`
--
ALTER TABLE `perso`
  ADD CONSTRAINT `perso` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
