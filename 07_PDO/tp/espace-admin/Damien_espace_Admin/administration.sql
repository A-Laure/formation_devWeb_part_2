CREATE DATABASE IF NOT EXISTS `administration` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `administration`;

DROP TABLE IF EXISTS `autorisation`;
CREATE TABLE IF NOT EXISTS `autorisation` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`aut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `autorisation`;
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(1, 'Lister');
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(2, 'Ajouter');
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(3, 'Editer');
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(4, 'Modifier');
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(5, 'Supprimer');
INSERT INTO `autorisation` (`aut_id`, `aut_libelle`) VALUES(6, 'Publier');

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_libelle` varchar(50) NOT NULL,
  `rol_pouvoir` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `role`;
INSERT INTO `role` (`rol_id`, `rol_libelle`, `rol_pouvoir`) VALUES(1, 'Super Admin', 1);
INSERT INTO `role` (`rol_id`, `rol_libelle`, `rol_pouvoir`) VALUES(2, 'Admin', 10);
INSERT INTO `role` (`rol_id`, `rol_libelle`, `rol_pouvoir`) VALUES(3, 'Invité', 100);
INSERT INTO `role` (`rol_id`, `rol_libelle`, `rol_pouvoir`) VALUES(4, 'Éditeur', 50);

DROP TABLE IF EXISTS `rel_role_autorisation`;
CREATE TABLE IF NOT EXISTS `rel_role_autorisation` (
  `rra_role` int(11) NOT NULL,
  `rra_autorisation` int(11) NOT NULL,
  PRIMARY KEY (`rra_role`,`rra_autorisation`),
  INDEX (`rra_autorisation`, `rra_role`),
  CONSTRAINT `rel_role_autorisation_role_ibfk` FOREIGN KEY (`rra_role`) REFERENCES `role` (`rol_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `rel_role_autorisation_autorisation_ibfk` FOREIGN KEY (`rra_autorisation`) REFERENCES `autorisation` (`aut_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `rel_role_autorisation`;
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 1);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 2);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 3);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 4);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 5);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(1, 6);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(2, 1);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(2, 3);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(2, 4);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(3, 1);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(4, 1);
INSERT INTO `rel_role_autorisation` (`rra_role`, `rra_autorisation`) VALUES(4, 3);

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_login` varchar(50) NOT NULL,
  `use_mdp` varchar(50) NOT NULL,
  `use_role` int(11) NOT NULL,
  PRIMARY KEY (`use_id`),
  INDEX (`use_role`),
  CONSTRAINT `user_role_ibfk` FOREIGN KEY (`use_role`) REFERENCES `role` (`rol_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `user`;
INSERT INTO `user` (`use_id`, `use_login`, `use_mdp`, `use_role`) VALUES(1, 'su', 'su@pwd', 1);
INSERT INTO `user` (`use_id`, `use_login`, `use_mdp`, `use_role`) VALUES(2, 'admin', 'admin@pwd', 2);
INSERT INTO `user` (`use_id`, `use_login`, `use_mdp`, `use_role`) VALUES(3, 'user', 'user@pwd',3);
INSERT INTO `user` (`use_id`, `use_login`, `use_mdp`, `use_role`) VALUES(4, 'editeur', 'edit@pwd',4);