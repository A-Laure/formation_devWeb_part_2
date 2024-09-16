-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 août 2024 à 14:08
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
  `idService` int(10) UNSIGNED DEFAULT NULL,
  `nom` varchar(75) DEFAULT NULL,
  `prenom` varchar(75) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `salaire` int(10) UNSIGNED DEFAULT NULL,
  `dateContrat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploy`, `idService`, `nom`, `prenom`, `sexe`, `salaire`, `dateContrat`) VALUES
(1, 1, 'Péron', 'Paul', 'M', 1600, '2022-07-11'),
(2, 1, 'Roche', 'Ken', 'M', 2000, '2021-02-08'),
(3, 2, 'Roche', 'Pascal', 'M', 1800, '1996-04-08'),
(4, 1, 'Rouvière', 'Emmeline', 'F', 1850, '2014-12-01'),
(5, NULL, 'Farré', 'Julie', 'F', 2200, '2018-03-19'),
(6, 3, 'Amar', 'Jean-Pierre', 'M', 1700, '2018-11-15'),
(7, 4, 'Trullu', 'Sébastien', 'M', 1400, '2023-02-20'),
(8, NULL, 'Legendre', 'Peter', 'M', 2100, '2018-09-19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploy`),
  ADD KEY `idService` (`idService`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploy` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
