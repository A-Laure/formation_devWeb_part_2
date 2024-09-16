
/* 
Ordre des clauses :
SELECT FROM
WHERE
GROUP BY
HAVING
ORDER BY
LIMIT
*/


-- SELECT (Read dans le CRUD)
SELECT * FROM `employe`;
SELECT `nom` FROM `employe`;
SELECT `nom`, `prenom`, `salaire` FROM `employe`;
SELECT DISTINCT `service` FROM `employe`;
SELECT DISTINCT `service`, `sexe` FROM `employe`;

-- LIMIT
SELECT `prenom` FROM `employe` LIMIT 2;
SELECT `prenom` FROM `employe` LIMIT 2, 3;

-- WHERE
SELECT `prenom` FROM `employe` WHERE `sexe` = 'F';
SELECT `prenom` FROM `employe` WHERE `sexe` != 'F';
SELECT `prenom`, `salaire` FROM `employe` WHERE `salaire` >= 2000;
SELECT `prenom`, `dateContrat` FROM `employe` WHERE `dateContrat` < '2016-01-01';

-- IS NULL
SELECT `prenom` FROM `employe` WHERE `service` IS NULL;
SELECT `prenom` FROM `employe` WHERE `service` IS NOT NULL;
SELECT `prenom` FROM `employe` WHERE ISNULL(`service`);
SELECT `prenom` FROM `employe` WHERE NOT ISNULL(`service`);

-- BETWEEN
SELECT `prenom`, `salaire` FROM `employe` WHERE `salaire` BETWEEN 1800 AND 3000;
SELECT `prenom` FROM `employe` WHERE `prenom` BETWEEN 'A' AND 'G';
SELECT `prenom`, `dateContrat` FROM `employe` WHERE `dateContrat` BETWEEN '2016-01-01' AND '2022-01-01';

-- IN
SELECT `prenom` FROM `employe` WHERE `salaire` IN (1800, 3000);
SELECT `prenom` FROM `employe` WHERE `salaire` IN (1700, 1800, 3000);
SELECT `prenom` FROM `employe` WHERE `nom` IN ('Roche', 'Péron');
SELECT `prenom` FROM `employe` WHERE `dateContrat` IN ('2016-01-01', '2022-01-01');

-- LIKE
SELECT `nom`, `prenom` FROM `employe` WHERE `nom` LIKE 'T%';
SELECT `nom`, `prenom` FROM `employe` WHERE `nom` LIKE '%E';
SELECT `nom`, `prenom` FROM `employe` WHERE `nom` LIKE 'R%E';
SELECT `nom`, `prenom` FROM `employe` WHERE `nom` LIKE '%E%';
SELECT `nom`, `prenom`, `salaire` FROM `employe` WHERE `salaire` LIKE '_0__';
SELECT `nom`, `prenom`, `salaire` FROM `employe` WHERE `salaire` LIKE '_0%';

-- AND
SELECT `nom`, `prenom`, `salaire` FROM `employe` WHERE `sexe` = 'F' AND `salaire` > 2000;
-- OR 
SELECT `nom`, `prenom`, `salaire` FROM `employe` WHERE `sexe` = 'F' OR `salaire` > 2000;
-- +, -, *, /, %
SELECT `nom`, `prenom`, `salaire` FROM `employe` WHERE `salaire`*12 < 25000;


-- CONCAT()
SELECT CONCAT(`nom`, ' ' , `prenom`) FROM `employe`;

-- AS (ALIAS)
SELECT CONCAT(`nom`, ' ' , `prenom`) AS `nomComplet` FROM `employe`;
SELECT CONCAT(`nom`, ' ' , `prenom`) `nomComplet` FROM `employe`;
SELECT CONCAT(`nom`, ' ' , `prenom`) `nomComplet`, `salaire` `salary` FROM `employe`;

-- ALIAS ne fonctionne pas avec le WHERE
SELECT CONCAT(`nom`, ' ' , `prenom`) AS `nomComplet` FROM `employe` WHERE `nomComplet` LIKE 'R%';
-- ALIAS fonctionne avec le HAVING
-- La condition HAVING en SQL est presque similaire à WHERE à la seule différence que HAVING permet de filtrer en utilisant des fonctions telles que SUM(), COUNT(), AVG(), MIN() ou MAX().
SELECT CONCAT(`nom`, ' ' , `prenom`) AS `nomComplet` FROM `employe` HAVING `nomComplet` LIKE 'R%';


-- ORDER BY
SELECT `nom`, `prenom` FROM `employe` ORDER BY `nom`;
SELECT `nom`, `prenom` FROM `employe` ORDER BY `nom`, `prenom`;
-- ORDER BY ASC (croissant) / ORDER BY DESC (décroissant)
SELECT `nom`, `prenom` FROM `employe` ORDER BY `nom` ASC;
SELECT `nom`, `prenom` FROM `employe` ORDER BY `nom` DESC;
SELECT `nom`, `prenom`, `salaire` FROM `employe` ORDER BY `salaire` DESC;
SELECT `nom`, `prenom`, `salaire` FROM `employe` ORDER BY `sexe` ASC,`salaire` DESC;


-- FONCTION D'AGGREGATION

-- COUNT(nomCol) => ne dénombre pas les NULL
SELECT COUNT(`service`) AS `nbService`, `nom`
FROM `employe`;

				-- POUR ENLEVER DOUBLON
				SELECT COUNT(DISTINCT `service`) AS `nbService`, `nom`
				FROM `employe`;

				-- POUR COMPTER LES NULL AUSSI : COUNT(COALESCE(`nomCol`, ''))
				SELECT COUNT(COALESCE(`service`, '')) AS `total_service`, 
				FROM `employe`;

				-- COUNT(COALESCE(`nomCol`, 'chaineDeCaracteres')) / permet de remplacer les valeurs NULL d'une colonne par une chaine de caractères, ici par test 
				-- !!!!! n'est pas un REPLACE
				SELECT COUNT(COALESCE(`service`, 'test')) AS `total_service`, 
				FROM `employe`;

-- min() / max () => interger et VARCHAR

SELECT MIN(`salaire`) AS `salaireMin` 
FROM `employe`;

-- revient à avoir par odre alpha, pour la longueur utiliser LENGTH()
SELECT MAX(`nom`) AS `nomMax` 
FROM `employe`;

SELECT MAX(`dateContrat`) AS `dateMax` 
FROM `employe`;

-- SUM()

SELECT SUM(`salaire`) AS `totalSalaire` 
FROM `employe`;

SELECT SUM(`salaire`) / count(*) AS `moyenne` 
FROM `employe`;

-- AVG() = average, moyenne

SELECT AVG(`salaire`) AS `totalSalaire` 
FROM `employe`;

-- GROUP BY()

SELECT AVG(`salaire`) AS `moyenne` 
FROM `employe`;

SELECT ROUND(AVG(`salaire`)) AS `moyenne` 
FROM `employe`;

SELECT ROUND(AVG(`salaire`,2)) AS `moyenne` 
FROM `employe`;

-- change le typage souvent du VARCHAR en INTEGER
SELECT CAST(AVG(`salaire` AS SIGNED INTEGER)) AS `moyenne`  
FROM `employe`;

-- GROUP BY
SELECT `sexe ` AVG(`salaire`) AS `salaireMoyen` 
FROM `employe`
GROUP BY `sexe`;

-- HAVING en SQL est presque similaire à WHERE à la seule différence que HAVING permet de filtrer en utilisant des fonctions telles que SUM(), COUNT(), AVG(), MIN() ou MAX().

-- ATTENTION le WHERE regarde la condition avant de faire la sélection
-- WHERE se lance avant de selectionner
-- HAVING dse lance en fin de requête
-- on utilise plus souvent le WHERE que le HAVING

-- 1/execute le where d'abord dc n'a pas conscience de l'alias d'où le HAVING car executé en fin de requête
-- !!dc ne marche pas
SELECT `service`, ROUND(AVG(`salaire`,2)) AS `salaireMoyen` 
FROM `employe`
WHERE `salaireMoyen` > 2000
GROUP BY `service`; -- !!dc ne marche pas

SELECT `service`, ROUND(AVG(`salaire`,2)) AS `salaireMoyen` 
FROM `employe`
GROUP BY `service`
HAVING `salaireMoyen` > 2000;

SELECT `service`, ROUND(AVG(`salaire`,2)) AS `salaireMoyen` 
FROM `employe`
WHERE `salaire` > 1800
GROUP BY `service`
HAVING `salaireMoyen` > 2000;


SELECT `sexe`, ROUND(AVG(`salaire`,2)) AS `salaireMoyen` 
FROM `employe`
WHERE `sexe` = 'F' 
GROUP BY `service`;

SELECT `sexe`, ROUND(AVG(`salaire`,2)) AS `salaireMoyen` 
FROM `employe`
GROUP BY `service`
HAVING `sexe` = 'F'; 








