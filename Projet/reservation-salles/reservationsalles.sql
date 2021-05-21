-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 28 jan. 2021 à 08:35
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
-- Base de données : `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(2, 'Test', 'Test gr&acirc;ce &agrave; guillaume plantevin', '2021-02-01 08:00:00', '2021-02-01 10:00:00', 28),
(3, 'Jeremy', 'Jeremy fait une reservation alors affihce la moi', '2021-02-01 13:00:00', '2021-02-01 14:00:00', 30),
(4, 'bonjour', 'test my god', '2021-01-27 14:00:00', '2021-01-27 16:00:00', 28),
(5, 'Guillaume', 'Formation Javascript', '2021-01-25 08:00:00', '2021-01-25 14:00:00', 31),
(7, 'Final', 'Test', '2021-03-03 06:00:00', '2021-03-03 23:00:00', 32),
(8, 'FINAL TEST', 'Test', '2021-01-01 00:00:00', '2021-01-01 00:01:00', 28);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(33, 'Gerard', '$2y$10$rEdr7h5HGybLXrKc/eDCm.Gj4.cOov3U9EV1F00CD7TReWbzSD9iK'),
(32, 'Final_Test', '$2y$10$0prVAd/nfJ4XVUiQImmM0OtCkwSz9Qpl1EHcXPWe18/AwKqj.unoi'),
(31, 'Guillaume', '$2y$10$/O9BUVszdUX5IrJsjqp1ueLYKLzxF9aJ5Use/xV4awFInC5YpxWz.'),
(30, 'Jeremy_sempai', '$2y$10$qflG1edVeYKhkICLlbnHmOG7aXiwDaU58uwolajxR/darhrwX9UZ.'),
(29, 'test', '$2y$10$4vt.u9EIfSFETwChABe9KO7qImjNIkNoxYa84SerBtVFJQkK7UlGK'),
(28, 'Marie', '$2y$10$twHm70Rnv28S52VEMbPFXeyt00W5r6su9.t8cjCNzgtAOXzV4gmvy'),
(27, 'Jojo', '$2y$10$n/0dGm2Qa8XGZAtasaGnBufjxXf8Fr7.SNqEwRaPdCD8RUhAJqIbC'),
(26, 'Fabien', '$2y$10$k1veKWiC.BlH9nslsR.B9.KKuZ7t8UMhzG2N6SO4WYEg/0AHcMS02'),
(25, 'Quentin', '$2y$10$nEtDR9Nz2QLoPTM2WTkvkeEHBxFQAZuJV0uCAvvYTy.4Gqpohn0m.'),
(24, 'Jeremy', '$2y$10$urDkln6L2fIyd5Xa2wzaF.T6ib6Mkc0DjYcfK79Q87MUT/8lX51zS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
