-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 31 juil. 2024 à 09:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `idEmploy` int(10) UNSIGNED NOT NULL,
  `nom` varchar(75) DEFAULT NULL,
  `prenom` varchar(75) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `service` varchar(25) DEFAULT NULL,
  `salaire` int(10) UNSIGNED DEFAULT NULL,
  `dateContrat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploy`, `nom`, `prenom`, `sexe`, `service`, `salaire`, `dateContrat`) VALUES
(1, 'Péron', 'Paul', 'M', 'IT', 1600, '2022-07-11'),
(2, 'Roche', 'Ken', 'M', 'IT', 2000, '2021-02-08'),
(3, 'Roche', 'Pascal', 'M', 'Marketing', 1800, '1996-04-08'),
(4, 'Rouvière', 'Emmeline', 'F', 'IT', 1850, '2014-12-01'),
(5, 'Farré', 'Julie', 'F', NULL, 2200, '2018-03-19'),
(6, 'Amar', 'Jean-Pierre', 'M', 'Commercial', 1700, '2018-11-15'),
(7, 'Trullu', 'Sébastien', 'M', 'Support', 1500, '2023-02-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploy`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploy` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
