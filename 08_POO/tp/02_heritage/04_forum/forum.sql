--
-- Création de la base de données `forum`
--
CREATE DATABASE IF NOT EXISTS `forum` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

--
-- Utilisation de la base de données `forum`
--
USE `forum`;

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
    `c_id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_date` DATETIME NOT NULL,
    `c_termine` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY( `c_id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des conversations du site';

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

CREATE TABLE IF NOT EXISTS `rang` (
    `r_id` INT(11) NOT NULL AUTO_INCREMENT,
    `r_libelle` VARCHAR(255) NOT NULL,
    PRIMARY KEY( `r_id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des rôles du site';

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
    `u_id` INT(11) NOT NULL AUTO_INCREMENT,
    `u_login` VARCHAR(30) NOT NULL,
    `u_prenom` VARCHAR(255) NULL DEFAULT NULL,
    `u_nom` VARCHAR(255) NULL DEFAULT NULL,
    `u_date_naissance` DATE NULL NULL,
    `u_date_inscription` DATETIME NOT NULL,
    `u_rang_fk` INT(11) NOT NULL,
    PRIMARY KEY( `u_id` ),
    INDEX( `u_rang_fk` ),
    CONSTRAINT `user_to_rang` FOREIGN KEY ( `u_rang_fk` ) REFERENCES `rang` ( `r_id` ) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des utilisateurs du site';

--
-- RELATIONS POUR LA TABLE `user`:
--   `u_rang_fk`
--       `rang` -> `r_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
    `m_id` INT(11) NOT NULL AUTO_INCREMENT,
    `m_contenu` VARCHAR(2040) NOT NULL,
    `m_date` DATETIME NOT NULL,
    `m_auteur_fk` INT(11) NOT NULL,
    `m_conversation_fk` INT(11) NOT NULL,
    PRIMARY KEY( `m_id` ),
    INDEX( `m_auteur_fk`, `m_conversation_fk` ),
    CONSTRAINT `message_to_user` FOREIGN KEY ( `m_auteur_fk` ) REFERENCES `user` ( `u_id` ) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `message_to_conversation` FOREIGN KEY ( `m_conversation_fk` ) REFERENCES `conversation` ( `c_id` ) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des messages du site';

--
-- RELATIONS POUR LA TABLE `message`:
--   `m_auteur_fk`
--       `user` -> `u_id`
--   `m_conversation_fk`
--       `conversation` -> `c_id`
--