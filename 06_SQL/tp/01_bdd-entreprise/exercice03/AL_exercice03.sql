
-- 1. Sélectionnez le prénom des employés qui gagnent plus que le salaire moyen. Tri par prénom ascendant.

--!! HAVING en SQL est presque similaire à WHERE à la seule différence que HAVING permet de filtrer en utilisant des fonctions telles que SUM(), COUNT(), AVG(), MIN() ou MAX().

-- SALAIRE MOYEN = 1831.25

--! marche pas nécessaire d'utiliser HAVING ici
SELECT  `prenom`, `salaire`
FROM `employe`
HAVING `salaire` > (SELECT AVG(`salaire`) FROM `employe`)
ORDER BY `prenom`;

-- Damien : -- Faut une sous requête
-- WHERE se lance avant de selectionner
-- HAVING dse lance en fin de requête
-- on utilise plus souvent le WHERE que le HAVING

SELECT  `prenom`, `salaire`
FROM `employe` 
WHERE `salaire` > (SELECT AVG(`salaire`)  FROM `employe`) --!! = sous requête
ORDER BY `prenom`;

-- 2. Sélectionnez le prénom des employés qui gagnent au moins 10% de plus que le salaire moyen. Tri par prénom ascendant.

-- SALAIRE MOYEN = 1831.25
-- 10% de + = 2014.37 (result = Julie et Peter)

--!! HAVING en SQL est presque similaire à WHERE à la seule différence que HAVING permet de filtrer en utilisant des fonctions telles que SUM(), COUNT(), AVG(), MIN() ou MAX().

SELECT  `prenom`, `salaire`
FROM `employe` 
WHERE `salaire` >= 1.1*(SELECT AVG(`salaire`)  FROM `employe`) 
ORDER BY `prenom`;


-- 3. Sélectionnez le nom complet Nom Prénom) alias nomComplet et le nom du service (alias serv) de chaque employé ayant un service. Tri par nom complet ascendant.


SELECT CONCAT( `e`.`nom`,' ', `e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `employe` `e`
JOIN  `service` `s` --! ou INNER JOIN c'est pareil = intersection des données
USING(`idService`) -- USING car les 2 col ont le même nom dans chaque table
--! ON est possible aussi mais plutôt qd on préfixe les colonnes car elles ont le même nom mais tables différentes
-- ON `e`.`idService` = `s`.`idService`
--! pas besoin de faire un where car INNER  prend les datas communes
-- WHERE `e`.`idService` IS NOT NULL 
ORDER BY `nomComplet`;


-- 4. Idem 3 + en affichant l'employé n'ayant pas de service.

-- !!LEFT JOIN : on inclut les données communes + les donnees de la table se trouvant à gauche du mot cle JOIN, ici c'est la table employe
-- !!RIGHT JOIN : on inclut les données communes + les donnees de la table se trouvant à droite du mot cle JOIN, ici c'est la table service

SELECT CONCAT( `e`.`nom`,' ',`e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `employe` `e`
--! je récupère les données sup (par rapport à `service`) de ma table de gauche soit ici `employe`
LEFT JOIN  `service` `s`
USING(`idService`)
ORDER BY `nomComplet`;


-- 5. Idem 3 + en affichant le service qui n'a pas d'employé.

-- !!LEFT JOIN : on inclut les données communes + les donnees de la table se trouvant à gauche du mot cle JOIN, ici c'est la table service

SELECT CONCAT( `e`.`nom`,' ',`e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `service` `s`
LEFT JOIN  `employe` `e`
USING(`idService`)
ORDER BY `nomComplet`;

          -- OU --

-- !!RIGHT JOIN : on inclut les données communes + les donnees de la table se trouvant à droite du mot cle JOIN, ici c'est la table service

SELECT CONCAT( `e`.`nom`,' ',`e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `employe` `e`
RIGHT JOIN  `service` `s`
USING(`idService`)
ORDER BY `nomComplet`;


-- 6. Idem 3 + en affichant l'employé qui n'a pas de service et le service qui n'a pas d employé.

--! 2 choses bien distinctes dc UNION = équivalent FULL JOIN qui n'existe pas en MySql
--! ATTENTION, il faut le même nbre de col, pas forcément les mêmes mais même nombre

SELECT CONCAT( `e`.`nom`,' ',`e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `employe` `e`
--! je récupère les données sup (par rapport à `service`) de ma table de gauche soit ici `employe`
LEFT JOIN  `service` `s`
USING(`idService`)
--! un seul ORDER BY et à la fin

UNION

-- !!RIGHT JOIN : on inclut les données communes + les donnees de la table se trouvant à droite du mot cle JOIN, ici c'est la table service

SELECT CONCAT( `e`.`nom`,' ',`e`.`prenom`) AS `nomComplet`, `s`.`nom` AS `serv`
FROM `employe` `e`
RIGHT JOIN  `service` `s`
USING(`idService`)
--! un seul ORDER BY et à la fin
ORDER BY `nomComplet`; 

-- 7. Sélectionnez le prénom des employées (alias emp) et le prénom de leur responsable alias resp). Tri par prénom des employés.

--! double JOIN

SELECT `e`.`prenom` AS `emp`, `r`.`prenom` AS `resp`
FROM `employe` `e`
JOIN `service` `s` --! = INNER JOIN 
USING(`idService`)
JOIN `responsable` `r` --! = INNER JOIN 
USING(`idResponsable`)
ORDER BY `e`.`prenom`; --! ou l'alias `emp`


-- 8. Sélectionnez la différence arrondie à un entier entre le salaire moyen des hommes et celui des femmes. Alias diff.

--! ABS pour être sûre valeur positive

SELECT ABS(
  ROUND(
    (SELECT AVG(`salaire`)FROM `employe`
WHERE `sexe` = 'M') - (SELECT AVG(`salaire`)FROM `employe`
WHERE `sexe` = 'F')
  )
  )AS `diff`

  -- !OU JOINTURE REFLEXIVE (JOIN sur même table)-- 

SELECT ABS(
  ROUND(AVG(`empM`.`salaire`) - AVG(`empF`.`salaire`))) AS `diff`
FROM `employe` `empM`
JOIN `employe` `empF`
ON `empM`.`sexe` = 'M' AND `empM`.`sexe` = 'F'


-- 9. Pour chaque service (sauf celui n'ayant pas d'employé), sélectionnez le nombre d'employés gagnant moins que la moyenne des employés. Alias nb. Tri par nom de service ascendant.

SELECT `s`.`nom` AS `serv`, COUNT(`e`.`idEmploye`) AS `nb`
FROM `service` `s`
JOIN `employe` `e` --! INNER JOIN car on ne veut ici récupérer que les données communes
USING(`idService`)
--! Pour salaire alias pas obligatoire car nom champ unique, pas dans l'autre table
WHERE `e`.`salaire` < (SELECT AVG(`salaire`) FROM `employe`)
-- ! Pour CHAQUE nom de service dc GROUP BY
GROUP BY  `s`.`nom`
ORDER BY  `s`.`nom` ASC;

-- 10. Pour chaque service y compris celui n'ayant pas d'employé, sélectionnez le nombre d'employés. Alias nb. Tri par nom de service ascendant.

--! idem mais sans la condition de salaire

SELECT `s`.`nom` AS `serv`, COUNT(`e`.`idEmploye`) AS `nb`
FROM `service` `s`
JOIN `employe` `e`  --! INNER JOIN car on ne veut ici récupérer que les données communes
USING(`idService`)
FROM `employe`)
-- ! Pour CHAQUE nom de service dc GROUP BY
GROUP BY  `s`.`nom`
ORDER BY  `s`.`nom` ASC;

