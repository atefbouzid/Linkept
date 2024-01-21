-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 26 avr. 2023 à 21:36
-- Version du serveur : 8.0.11
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `linkept`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `CIN` varchar(8) NOT NULL,
  `MOT_DE_PASSE` varchar(50) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `ANNEE_ADH` int(4) NOT NULL,
  `STATUT` varchar(45) NOT NULL DEFAULT 'Etudiant',
  `EMAIL` varchar(200) NOT NULL,
  `NUMTEL` varchar(50) DEFAULT NULL,
  `DO` varchar(30) NOT NULL DEFAULT 'TC',
  `DESCRIPTION` varchar(500) DEFAULT NULL,
  `EXPERIENCE` varchar(500) DEFAULT NULL,
  `FACEBOOK` varchar(100) DEFAULT NULL,
  `INSTAGRAM` varchar(100) DEFAULT NULL,
  `LINKEDIN` varchar(100) DEFAULT NULL,
  `GITHUB` varchar(100) DEFAULT NULL,
  `TWITTER` varchar(100) DEFAULT NULL,
  `YOUTUBE` varchar(100) DEFAULT NULL,
  `SITEWEB` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`CIN`, `MOT_DE_PASSE`, `NOM`, `PRENOM`, `ANNEE_ADH`, `STATUT`, `EMAIL`, `NUMTEL`, `DO`, `DESCRIPTION`, `EXPERIENCE`, `FACEBOOK`, `INSTAGRAM`, `LINKEDIN`, `GITHUB`, `TWITTER`, `YOUTUBE`, `SITEWEB`) VALUES
('11112222', '11112222', 'by', 'rayhane', 2022, 'Etudiant', 'rayhane@gmail.com', '2222222222', 'TC', 'etuu', 'cc', 'www.facebook.com', 'www.instagram.com', 'a', 'aa', 'c', 'd', 'f'),
('12345678', '12345678', 'testnom', 'testprenom', 2023, 'Etudiant', 'test@gmail.com', '123456789', 'TC', 'AA', 'BB', 'facebook.com', 'instagram.com', 'linkedin.com', 'github.com', 'twitter.com', 'youtube.com', 'google.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`CIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
