-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 02 août 2024 à 16:03
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
  `idEmploye` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `employe` (`idEmploye`, `idService`, `nom`, `prenom`, `sexe`, `salaire`, `dateContrat`) VALUES
(1, 1, 'Péron', 'Paul', 'M', 1600, '2022-07-11'),
(2, 1, 'Roche', 'Ken', 'M', 2000, '2021-02-08'),
(3, 2, 'Roche', 'Pascal', 'M', 1800, '1996-04-08'),
(4, 1, 'Rouvière', 'Emmeline', 'F', 1850, '2014-12-01'),
(5, NULL, 'Farré', 'Julie', 'F', 2200, '2018-03-19'),
(6, 3, 'Amar', 'Jean-Pierre', 'M', 1700, '2018-11-15'),
(7, 4, 'Trullu', 'Sébastien', 'M', 1400, '2023-02-20'),
(8, NULL, 'Legendre', 'Peter', 'M', 2100, '2018-09-19');

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `idResponsable` int(10) UNSIGNED NOT NULL,
  `nom` varchar(75) NOT NULL,
  `prenom` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`idResponsable`, `nom`, `prenom`) VALUES
(1, 'Guignabaudet', 'Damien'),
(2, 'Lenormand', 'Jeanne-Marie'),
(3, 'Pace', 'Fred'),
(4, 'Nalin', 'Fabien');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `idService` int(10) UNSIGNED NOT NULL,
  `idResponsable` int(10) UNSIGNED NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`idService`, `idResponsable`, `nom`) VALUES
(1, 1, 'IT'),
(2, 2, 'Marketing'),
(3, 3, 'Commercial'),
(4, 4, 'Support');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploye`),
  ADD KEY `idService` (`idService`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`idResponsable`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`),
  ADD KEY `idResponsable` (`idResponsable`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploye` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `idResponsable` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`idResponsable`) REFERENCES `responsable` (`idResponsable`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
