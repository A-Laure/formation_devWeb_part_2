-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 oct. 2024 à 16:57
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
-- Structure de la table `advertstatus`
--

CREATE TABLE `advertstatus` (
  `stst_advertStatusId` int(11) NOT NULL,
  `stst_advertStatusLabel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `advertstatus`
--

INSERT INTO `advertstatus` (`stst_advertStatusId`, `stst_advertStatusLabel`) VALUES
(1, 'Open'),
(2, 'Closed'),
(3, 'ON WAY'),
(4, 'Postuled');

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
(1, 2),
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
(2, 1),
(2, 4),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `followed`
--

CREATE TABLE `followed` (
  `joba_jobAdvertId` int(11) NOT NULL,
  `stst_advertStatusId` int(11) NOT NULL,
  `stst_advertStatusLabel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `followed`
--

INSERT INTO `followed` (`joba_jobAdvertId`, `stst_advertStatusId`, `stst_advertStatusLabel`) VALUES
(1, 1, 'Open');

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
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `jobadvert`
--

CREATE TABLE `jobadvert` (
  `joba_jobAdvertId` int(11) NOT NULL,
  `joba_jobLabel` varchar(50) DEFAULT NULL,
  `joba_jobContractType` varchar(50) DEFAULT NULL,
  `joba_jobDescription` varchar(500) DEFAULT NULL,
  `joba_jobAdvantages` varchar(500) DEFAULT NULL,
  `joba_jobTown` varchar(100) DEFAULT NULL,
  `user_userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jobadvert`
--

INSERT INTO `jobadvert` (`joba_jobAdvertId`, `joba_jobLabel`, `joba_jobContractType`, `joba_jobDescription`, `joba_jobAdvantages`, `joba_jobTown`, `user_userId`) VALUES
(1, 'Software Engineer', 'CDD', 'Develop backend systems for our platform.', 'Flexible hours, Health insurance', 'San Francisco', 1),
(2, 'Frontend Developer', 'CDI', 'Build and optimize user-facing features.', 'Remote options, Paid time off', 'Austin', 2),
(3, 'Project Manager', 'ALTERNANCE', 'Lead project teams and manage timelines.', 'Professional development, Annual bonuses', 'Denver', 3);

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
(1, 'LinkedIn'),
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
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_userId` int(11) NOT NULL,
  `user_userStatus` varchar(20) DEFAULT NULL,
  `user_userEnvrnt` varchar(100) DEFAULT NULL,
  `user_userPwd` varchar(150) DEFAULT NULL,
  `user_userFirstName` varchar(50) DEFAULT NULL,
  `user_userTextaera` varchar(300) DEFAULT NULL,
  `user_userLastName` varchar(50) DEFAULT NULL,
  `user_userSpeciality` varchar(50) DEFAULT NULL,
  `user_userAdr1` varchar(100) DEFAULT NULL,
  `user_userAdr2` varchar(100) DEFAULT NULL,
  `user_userTown` varchar(100) DEFAULT NULL,
  `user_userCp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_userId`, `user_userStatus`, `user_userEnvrnt`, `user_userPwd`, `user_userFirstName`, `user_userTextaera`, `user_userLastName`, `user_userSpeciality`, `user_userAdr1`, `user_userAdr2`, `user_userTown`, `user_userCp`) VALUES
(1, 'etudiant', 'IT', '$2y$10$eRK2WiYxCIOR06pnX8nlFu.0q3kzcoRjLTAeMkzgeqE', 'Alice', 'Experienced in project management.', 'Smith', 'designer', '123 Main St', 'Apt 4', 'New York', 10001),
(2, 'entreprise', 'IT', '$2y$10$sVHNIW2fDfjIWGHS0BEWJu9g834E9AJnPolq494si0kaEWWD78Wxq', 'Atos', 'Software engineer with a focus on backend.', '', 'designer', '456 Maple Ave', '', 'Los Angeles', 90001),
(3, 'admin', 'Hybrid', '$2y$10$TJDxmd2Be0CFZy98iLtS9.omQ4O02a1DugIsnb6gNKDTOEwHvxpXG', 'Charlie', 'Frontend development expertise.', 'Brown', 'aministrateur', '789 Oak St', 'Suite 12', 'Chicago', 60601);

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
(2, 3),
(2, 5),
(3, 1),
(3, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advertstatus`
--
ALTER TABLE `advertstatus`
  ADD PRIMARY KEY (`stst_advertStatusId`,`stst_advertStatusLabel`);

--
-- Index pour la table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`user_userId`,`joba_jobAdvertId`),
  ADD KEY `joba_jobAdvertId` (`joba_jobAdvertId`);

--
-- Index pour la table `display`
--
ALTER TABLE `display`
  ADD PRIMARY KEY (`user_userId`,`netw_networkId`),
  ADD KEY `netw_networkId` (`netw_networkId`);

--
-- Index pour la table `followed`
--
ALTER TABLE `followed`
  ADD PRIMARY KEY (`joba_jobAdvertId`,`stst_advertStatusId`,`stst_advertStatusLabel`),
  ADD KEY `stst_advertStatusId` (`stst_advertStatusId`,`stst_advertStatusLabel`);

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
  ADD KEY `user_userId` (`user_userId`);

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
-- Index pour la table `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT pour la table `advertstatus`
--
ALTER TABLE `advertstatus`
  MODIFY `stst_advertStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `jobadvert`
--
ALTER TABLE `jobadvert`
  MODIFY `joba_jobAdvertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `users` (`user_userId`),
  ADD CONSTRAINT `apply_ibfk_2` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`);

--
-- Contraintes pour la table `display`
--
ALTER TABLE `display`
  ADD CONSTRAINT `display_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `users` (`user_userId`),
  ADD CONSTRAINT `display_ibfk_2` FOREIGN KEY (`netw_networkId`) REFERENCES `socialnetwork` (`netw_networkId`);

--
-- Contraintes pour la table `followed`
--
ALTER TABLE `followed`
  ADD CONSTRAINT `followed_ibfk_1` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`),
  ADD CONSTRAINT `followed_ibfk_2` FOREIGN KEY (`stst_advertStatusId`,`stst_advertStatusLabel`) REFERENCES `advertstatus` (`stst_advertStatusId`, `stst_advertStatusLabel`);

--
-- Contraintes pour la table `has`
--
ALTER TABLE `has`
  ADD CONSTRAINT `has_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `users` (`user_userId`),
  ADD CONSTRAINT `has_ibfk_2` FOREIGN KEY (`skill_skillId`) REFERENCES `techskills` (`skill_skillId`);

--
-- Contraintes pour la table `jobadvert`
--
ALTER TABLE `jobadvert`
  ADD CONSTRAINT `jobadvert_ibfk_1` FOREIGN KEY (`user_userId`) REFERENCES `users` (`user_userId`);

--
-- Contraintes pour la table `want`
--
ALTER TABLE `want`
  ADD CONSTRAINT `want_ibfk_1` FOREIGN KEY (`joba_jobAdvertId`) REFERENCES `jobadvert` (`joba_jobAdvertId`),
  ADD CONSTRAINT `want_ibfk_2` FOREIGN KEY (`skill_skillId`) REFERENCES `techskills` (`skill_skillId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
