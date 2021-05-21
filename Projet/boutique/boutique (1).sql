-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 14 avr. 2021 à 11:22
-- Version du serveur :  8.0.21
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_cat`) VALUES
(3, 'Coopératif'),
(4, 'Jeux de Cartes'),
(5, 'Grand Public'),
(6, 'Stratégie');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `date`, `id_user`) VALUES
(18, '2021-04-13 14:42:36', 5);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) NOT NULL,
  `id_produit` int NOT NULL,
  `date` timestamp NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produit` (`id_produit`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_produit`, `date`, `id_user`) VALUES
(11, 'Ce jeux est super génial tout est super génial', 6, '2021-04-13 12:42:06', 5);

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'Utilisateurs'),
(1337, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `facoprod`
--

DROP TABLE IF EXISTS `facoprod`;
CREATE TABLE IF NOT EXISTS `facoprod` (
  `id_produits` int NOT NULL,
  `id_commande` int NOT NULL,
  KEY `id_produits` (`id_produits`),
  KEY `id_commande` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `facoprod`
--

INSERT INTO `facoprod` (`id_produits`, `id_commande`) VALUES
(6, 18);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `prix` float NOT NULL,
  `stock` int NOT NULL,
  `titleImg` longtext NOT NULL,
  `FullNameImg` longtext NOT NULL,
  `orderImg` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `stock`, `titleImg`, `FullNameImg`, `orderImg`) VALUES
(6, 'Sherlock', 'Sherlock Holmes Detective Conseil est un jeu coopératif dans lequel vous enquêtez sur les mêmes affaires que le plus fameux des détectives. Suivez les pistes, recueillez les indices et tentez de rivaliser avec Sherlock Holmes en résolvant les enquêtes à votre façon. Il n’est pas nécessaire de posséder une autre boîte de la gamme \"Sherlock Holmes Detective Conseil\" pour profiter de ces aventures', 35, 12, 'Sherlock Holmes jeux de société', 'sherlock-holmes-jeux-de-société.6075578f679011.37429609.jpg', 1),
(7, 'Uno', 'Jeux de cartes entre amis basé sur le jeux du 8 américain', 10, 200, 'Uno jeux de cartes', 'uno-jeux-de-cartes.607561735e38e6.11193633.png', 7),
(8, 'Monopoly', 'Jeux de société basé sur le capitalisme, achété le plus de propriété possible et rammassez l\'argent de vos concurents', 25, 355, 'Monopoly', 'monopoly-jeux-de-société.607561c7b9d253.50623489.jpg', 7),
(9, 'Puissance 4', 'Jeux de société à deux joueurs, soyez le plus rapide à faire une ligne ou collonne de 4 jetons', 15, 56, 'Puissance 4', 'puissance-4.60756208ecc196.29100597.png', 7),
(11, 'Qui est ce', 'soyez le plus rapides a decouvrir qui se cahce derière votre adversaire', 15, 102, 'Qui est ce', 'qui-est-ce-jeux-de-société.607562b9b5c7e6.79525338.png', 7),
(12, 'Risk', 'Risk : le jeu de conquête stratégique !Risk est un jeu de guerre et de stratégie qui est connu à travers le monde depuis de nombreuses années.Ce jeu de société vous placera à la tête d\'une armée possédant une couleur et vous devrez réussir une mission que vous aurez tirée au sort au début de la partie. Mais, même si vous vous démontrez être un fin stratège, vos actions auront parfois de malheureuses répercussions pour la suite de la partie.Il vous faudra être patient, observateur et surtout posséder un bon esprit d\'analyse...', 42, 12, 'Risk', 'risk-jeux-de-société.607563302d63b3.51340588.png', 7);

-- --------------------------------------------------------

--
-- Structure de la table `prod_cat`
--

DROP TABLE IF EXISTS `prod_cat`;
CREATE TABLE IF NOT EXISTS `prod_cat` (
  `id_produits` int NOT NULL,
  `id_categorie` int NOT NULL,
  KEY `id_produits` (`id_produits`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `prod_cat`
--

INSERT INTO `prod_cat` (`id_produits`, `id_categorie`) VALUES
(6, 3),
(7, 4),
(8, 5),
(9, 5),
(11, 5),
(12, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_droits` (`id_droits`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(5, 'Jeremy', '$2y$10$/FDUfbedRNethkoJGKNP8ueTaRfvbP.Ak9C8wiUKU9.CzmXgB4CXy', 'Jeremy@jeremy', 1337);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facoprod`
--
ALTER TABLE `facoprod`
  ADD CONSTRAINT `facoprod_ibfk_1` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facoprod_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `prod_cat`
--
ALTER TABLE `prod_cat`
  ADD CONSTRAINT `prod_cat_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_cat_ibfk_2` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_droits`) REFERENCES `droits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
