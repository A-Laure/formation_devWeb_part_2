-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 11 oct. 2024 à 16:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jobdating`
--

-- --------------------------------------------------------

--
-- Structure de la table `apply`
--

CREATE TABLE `apply` (
  `user_userId` int(11) NOT NULL,
  `joba_jobAdvertId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apply`
--

INSERT INTO `apply` (`user_userId`, `joba_jobAdvertId`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `display`
--

CREATE TABLE `display` (
  `user_userId` int(11) NOT NULL,
  `netw_networkId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `display`
--

INSERT INTO `display` (`user_userId`, `netw_networkId`) VALUES
(1, 1),
(1, 2),
(3, 2),
(3, 3),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `has`
--

CREATE TABLE `has` (
  `user_userId` int(11) NOT NULL,
  `skill_skillId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `has`
--

INSERT INTO `has` (`user_userId`, `skill_skillId`) VALUES
(1, 1),
(1, 3),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `jobadvert`
--

CREATE TABLE `jobadvert` (
  `joba_jobAdvertId` int(11) NOT NULL,
  `joba_jobLabel` varchar(50) DEFAULT NULL,
  `joba_jobEmail` varchar(100) NOT NULL,
  `joba_jobContractType` varchar(50) DEFAULT NULL,
  `joba_jobDescription` varchar(100) DEFAULT NULL,
  `joba_jobAdvantages` varchar(500) DEFAULT NULL,
  `joba_jobTown` varchar(100) DEFAULT NULL,
  `user_userId` int(11) NOT NULL,
  `joba_jobStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jobadvert`
--

INSERT INTO `jobadvert` (`joba_jobAdvertId`, `joba_jobLabel`, `joba_jobEmail`, `joba_jobContractType`, `joba_jobDescription`, `joba_jobAdvantages`, `joba_jobTown`, `user_userId`, `joba_jobStatus`) VALUES
(1, 'Software Engineer bis', 'entreprise@gmail.com', 'CDI', 'En dernière année de formation bac+5 (Ecole d\'ingénieur, Master Informatique), vous souhaitez vous o', 'Flexible hours, Health insurance BIS', 'San Franciscobis', 5, 'CDD'),
(3, 'Project Manager', 'job2@email.com', 'ALTERNANCE', 'FLYING EYE, situé au cœur de la technopôle de Sophia Antipolis, est le leader français de la vente d', 'Professional development, Annual bonuses', 'Denver', 3, 'Pourvue');

-- --------------------------------------------------------

--
-- Structure de la table `needs`
--

CREATE TABLE `needs` (
  `joba_jobAdvertId` int(11) NOT NULL,
  `netw_networkId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `needs`
--

INSERT INTO `needs` (`joba_jobAdvertId`, `netw_networkId`) VALUES
(1, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `socialnetwork`
--

CREATE TABLE `socialnetwork` (
  `netw_networkId` int(11) NOT NULL,
  `netw_networkLabel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `socialnetwork`
--

INSERT INTO `socialnetwork` (`netw_networkId`, `netw_networkLabel`) VALUES
(1, 'Linkedin'),
(2, 'GitHub'),
(3, 'Twitter'),
(4, 'Facebook');

-- --------------------------------------------------------

--
-- Structure de la table `techskills`
--

CREATE TABLE `techskills` (
  `skill_skillId` int(11) NOT NULL,
  `skill_skillLabel` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `techskills`
--

INSERT INTO `techskills` (`skill_skillId`, `skill_skillLabel`) VALUES
(1, 'Java'),
(2, 'Python'),
(3, 'JavaScript'),
(4, 'SQL'),
(5, 'HTML/CSS');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_userId` int(11) NOT NULL,
  `user_userStatus` varchar(20) DEFAULT NULL,
  `user_userEnvrnt` varchar(100) DEFAULT NULL,
  `user_userEmail` varchar(75) NOT NULL,
  `user_userPwd` varchar(150) DEFAULT NULL,
  `user_userFirstName` varchar(50) DEFAULT NULL,
  `user_userTextaera` varchar(300) DEFAULT NULL,
  `user_userLastName` varchar(50) NOT NULL,
  `user_userSpeciality` varchar(50) DEFAULT NULL,
  `user_userAdr1` varchar(100) DEFAULT NULL,
  `user_userAdr2` varchar(100) DEFAULT NULL,
  `user_userTown` varchar(100) DEFAULT NULL,
  `user_userCp` int(11) DEFAULT NULL,
  `user_userLastMove` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_userId`, `user_userStatus`, `user_userEnvrnt`, `user_userEmail`, `user_userPwd`, `user_userFirstName`, `user_userTextaera`, `user_userLastName`, `user_userSpeciality`, `user_userAdr1`, `user_userAdr2`, `user_userTown`, `user_userCp`, `user_userLastMove`) VALUES
(1, 'Smith', 'IT', 'etudiant@gmail.com', '$2y$10$lfmKRKQt1Ho8mUXtKMS.3OlMtRnkLssM7tXvP7iQInOTWLjt97sc.', 'AliceModif', '', 'Etudiant', 'designer', '123', 'Apt', 'New', 10001, '2024-10-08 06:59:27'),
(3, 'Administrateur', 'Hybrid', 'admin@gmail.com', '$2y$10$TJDxmd2Be0CFZy98iLtS9.omQ4O02a1DugIsnb6gNKDTOEwHvxpXG', 'Charlie', 'Frontend development expertise.', 'Brown', 'Aministrateur', '789 Oak St', 'Suite 12', 'Chicago', 60601, '2024-10-08 06:59:27'),
(4, 'Etudiant', 'IT', 'etudiant@gmail.com', '$2y$10$OFbNcfqcrcD4vPVTIVRTCekso3tSeM431BWqurmW49WLV8/wukoJy', 'John', 'vdsxgbssrgdbis\r\nChange', 'Doe', 'Designer', 'adr1ter', 'adr2ter', 'Vendarguester', 347406, '2024-10-11 09:16:13'),
(5, 'Entreprise', 'IT', 'entreprise@gmail.com', '$2y$10$XwhFkj83xiD2EEPKTO5EX.tkp8SolNwJK1o6mXbFIrUrkT65L3x6C', 'Atosbis', 'Notre organisation et ses 138 partenaires publicitaires (IAB) stockent et/ou accèdent à des informations, telles que les identifiants uniques de cookies pour traiter les données personnelles, sur un appareil. Vous pouvez accepter ou gérer vos préférences en cliquant ci-dessous ou à tout moment dans ', '', 'Designerbis', 'adr1', 'adr2', 'town', 35698, '2024-10-11 10:16:35');

-- --------------------------------------------------------

--
-- Structure de la table `want`
--

CREATE TABLE `want` (
  `joba_jobAdvertId` int(11) NOT NULL,
  `skill_skillId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `want`
--

INSERT INTO `want` (`joba_jobAdvertId`, `skill_skillId`) VALUES
(1, 1),
(1, 4),
(3, 1),
(3, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`user_userId`,`joba_jobAdvertId`),
  ADD KEY `apply_ibfk_2` (`joba_jobAdvertId`);

--
-- Index pour la table `display`
--
ALTER TABLE `display`
  ADD PRIMARY KEY (`user_userId`,`netw_networkId`),
  ADD KEY `netw_networkId` (`netw_networkId`);

--
-- Index pour la table `has`
--
ALTER TABLE `has`
  ADD PRIMARY KEY (`user_userId`,`skill_skillId`),
  ADD KEY `skill_skillId` (`skill_skillId`);

--
-- Index pour la table `jobadvert`
--
ALTER TABLE `jobadvert`
  ADD PRIMARY KEY (`joba_jobAdvertId`),
  ADD KEY `jobadvert_ibfk_1` (`user_userId`);

--
-- Index pour la table `needs`
--
ALTER TABLE `needs`
  ADD PRIMARY KEY (`joba_jobAdvertId`,`netw_networkId`),
  ADD KEY `netw_networkId` (`netw_networkId`);

--
-- Index pour la table `socialnetwork`
--
ALTER TABLE `socialnetwork`
  ADD PRIMARY KEY (`netw_networkId`);

--
-- Index pour la table `techskills`
--
ALTER TABLE `techskills`
  ADD PRIMARY KEY (`skill_skillId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_userId`);

--
-- Index pour la table `want`
--
ALTER TABLE `want`
  ADD PRIMARY KEY (`joba_jobAdvertId`,`skill_skillId`),
  ADD KEY `skill_skillId` (`skill_skillId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `jobadvert`
--
ALTER TABLE `jobadvert`
  MODIFY `joba_jobAdvertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `socialnetwork`
--
ALTER TABLE `socialnetwork`
  MODIFY `netw_networkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `techskills`
--
ALTER TABLE `techskills`
  MODIFY `skill_skillId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`user_userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `apply_ibfk_2` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`) ON DELETE CASCADE;

--
-- Contraintes pour la table `display`
--
ALTER TABLE `display`
  ADD CONSTRAINT `display_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`user_userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `display_ibfk_2` FOREIGN KEY (`netw_networkId`) REFERENCES `socialnetwork` (`netw_networkId`);

--
-- Contraintes pour la table `has`
--
ALTER TABLE `has`
  ADD CONSTRAINT `has_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`user_userId`),
  ADD CONSTRAINT `has_ibfk_2` FOREIGN KEY (`skill_skillId`) REFERENCES `techskills` (`skill_skillId`);

--
-- Contraintes pour la table `jobadvert`
--
ALTER TABLE `jobadvert`
  ADD CONSTRAINT `jobadvert_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`user_userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `needs`
--
ALTER TABLE `needs`
  ADD CONSTRAINT `needs_ibfk_1` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`),
  ADD CONSTRAINT `needs_ibfk_2` FOREIGN KEY (`netw_networkId`) REFERENCES `socialnetwork` (`netw_networkId`);

--
-- Contraintes pour la table `want`
--
ALTER TABLE `want`
  ADD CONSTRAINT `want_ibfk_1` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`) ON DELETE CASCADE,
  ADD CONSTRAINT `want_ibfk_2` FOREIGN KEY (`skill_skillId`) REFERENCES `techskills` (`skill_skillId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
