/* 
Ordre des clauses :
SELECT FROM
WHERE
GROUP BY
HAVING
ORDER BY
LIMIT
*/

-- BDD entreprise_1

-- 1/ Sélectionner le nom et le prénom des employés masculins qui gagnent plus de 1800€ :

SELECT `nom`, `prenom`
FROM `employe`
WHERE `sexe` = 'M' AND `salaire` > 1800;

-- 2/ Sélectionner le nom et le prénom des 3 employés qui gagnent le plus, triés par salaire descendant :

SELECT `nom`, `prenom`
FROM `employe`
ORDER BY `salaire` DESC
LIMIT 3;

-- 3/ Sélectionner le plus petit salaire aliasé en 'salaireMin' :

SELECT MIN(`salaire`) AS `salaireMin`
FROM `employe`;

SELECT `salaire` `salaireMin `
FROM `employe`
ORDER BY `salaire`
LIMIT 1;

-- 4/ Sélectionner les noms des employés et trier par nom ascendant :

SELECT `nom`
FROM `employe`
ORDER BY nom ASC;

-- 5/ Sélectionner le salaire de l'employé qui n'a pas de service :

SELECT `salaire`
FROM `employe`
WHERE IS NULL(`salaire`);

SELECT `salaire`
FROM `employe`
WHERE service IS NULL;

-- 6/ Sélectionner les noms et prénoms des employés triés par ancienneté, du plus ancien au plus récemment embauché :

SELECT `nom`, `prenom`
FROM `employe`
ORDER BY `dateContrat` ASC;

SELECT CONCAT(`nom`, ' ', `prenom`) 'nomComplet',
FROM `employe`
ORDER BY `dateContrat` ASC;

-- 7/ Sélectionner les noms et prénoms des employés du service IT, triés par nom puis prénom :

SELECT `nom`, `prenom`
FROM `employe`
WHERE service = 'IT'
ORDER BY `nom` ASC, `prenom` ASC;

-- 8/ Sélectionner le prénom du second employé qui gagne le plus :

-- Syntaxe pour tous les autres mais MySQL l'accepe aussi, mieux car en cas de migration, pas de pb de syntaxe
SELECT `prenom`
FROM `employe`
ORDER BY `salaire` DESC
LIMIT 1
OFFSET 1; -- offset de 1 = le deuxième, même logique que les index dc "1 = 2"

-- Syntaxe MySQL
SELECT `prenom`
FROM `employe`
ORDER BY `salaire` DESC
LIMIT 1, 1;


-- 9/ Sélectionner le service de l'employé qui gagne 1800 :

SELECT service
FROM `employe`
WHERE `salaire` = 1800;

-- 10/ Sélectionner le service dans lequel travaille l'employé qui gagne le plus :

SELECT service
FROM `employe`
ORDER BY `salaire` DESC
LIMIT 1;
