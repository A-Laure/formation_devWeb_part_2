--! penser à regarder si travailler sur la fk ne suffit pas du coup pas besoin de join

-- 1.Les 10 derniers msg de l'utilisateur d'id=10

SELECT `m_contenu`, `m_auteur_fk`
FROM `message`
WHERE `m_auteur_fk` = 10
ORDER BY `m_date`;

-- DAMIEN
SELECT *
FROM `message`
WHERE `m_auteur_fk` = 10
ORDER BY `m_date` DESC
LIMIT 10;

-- 2.La liste des utilisateurs triés par âge

SELECT CONCAT(`u_nom`,' ',`u_prenom`), `u_date_naissance`
FROM `user`
ORDER BY `u_date_naissance`;

-- DAMIEN
SELECT `u_nom`,`u_prenom`, `u_date_naissance`
FROM `user`
ORDER BY `u_date_naissance`;


-- 3.Les 5 derniers inscrits

SELECT CONCAT(`u_nom`,' ',`u_prenom`), `u_date_inscription`
FROM `user`
ORDER BY `u_date_inscription` DESC
LIMIT 5;

-- DAMIEN
SELECT *
FROM `user`
ORDER BY `u_date_inscription`
LIMIT 5;

-- 4.Les 20 derniers messages avec l'utilisateur(login)associé et son rang
--! Faut forcément un ON ou un USING() avc JOIN
-- DAMIEN
SELECT `m_contenu`,`u_login`, `r_libelle`
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `r_id` = `u_rang_fk`
ORDER BY `m_date` DESC
LIMIT 20;

-- 5.Les 5 derniers messages des utilisateurs de rang admin de plus de 18  ans

-- DAMIEN SOL 1
SELECT *
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `r_id` = `u_rang_fk`
-- WHERE `r_libelle` = `admin` pas bon car si intitulé change.... dc faire sur id
WHERE `r_id` = 2
AND (YEAR(CURRENT_DATE()) - YEAR(`u_date_naissance`)) > 18,  -- pas super bon car seuelement sur l'année et non jour et date soit âge exact
ORDER BY `m_date` DESC
LIMIT 5;

-- DAMIEN SOL 2 plus opti pour serveur (poids fichier PHP)
SELECT *
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id`
WHERE `u_rang_fk` = 2 -- car = `r_id`
AND (YEAR(CURRENT_DATE()) - YEAR(`u_date_naissance`)) > 18,  -- pas super bon car seulement sur l'année et non jour et date soit âge exact
ORDER BY `m_date` DESC
LIMIT 5;

-- DAMIEN SOL 3 avec 18 ans révolu
SELECT *
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id`
WHERE `u_rang_fk` = 2 -- car = `r_id`
WHERE ROUND(DATEDIFF(CURRENT_DATE(), `u_date_naissance`)/365) >= 18 
ORDER BY `m_date` DESC
LIMIT 5;

--! DAMIEN SOL 4 PROPRE A MYSQL marche pas avec les autres dc attention si migration future
SELECT *
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id`
WHERE `u_rang_fk` = 2 -- car = `r_id`
WHERE TIMESTAMPDATEDIFF(YEAR,`u_date_naissance`, CURDATE()) >= 18 
ORDER BY `m_date` DESC
LIMIT 5;



-- 6.Les 10 derniers messages avec login + N°de conversation des users âgés de 18 à 30 ans

SELECT `m_contenu`,`m_date`,`u_date_naissance`, `u_login`, `m_conversation_fk` AS `numConv`
FROM `message`
JOIN  `user`
ON `m_auteur_fk` = `u_id` 
-- JOIN `conversation` 
-- ON `c_date` =`m_date`
--!Pas besoin du join sue conversation car on a la fk `m_conversation_fk` dans `message`
WHERE ROUND(DATEDIFF(CURRENT_DATE(), `u_date_naissance`)/365) BETWEEN 18 AND 30
ORDER BY `m_date` DESC
LIMIT 10;


-- DAMIEN 
SELECT `m_contenu`, `u_login`,`m_conversation_fk`
FROM `message`
JOIN  `user` ON `m_auteur_fk` = `u_id` 
WHERE ROUND(DATEDIFF(CURRENT_DATE(), `u_date_naissance`)/365) BETWEEN 18 AND 30
ORDER BY `m_date` DESC
LIMIT 10;


-- 7.Afficher la conversation c_id=9 avec msg + date msg + prenom + nom

SELECT `c_id`, `u_nom`,  `u_prenom`, `m_date`, `m_contenu`
FROM `conversation` 
JOIN  `message`
ON `c_id` = 9
JOIN `user`
ON `m_auteur_fk` = `u_id`;

-- DAMIEN SOL 1

SELECT `m_contenu`,`m_date`, `u_prenom`,`u_nom`  
FROM `user`
JOIN  `message` ON `m_auteur_fk` = `u_id`
JOIN  `conversation` ON `m_conversation_fk` = `c_id`
WHERE `c_id` = 9;

-- DAMIEN SOL 2 plus opti on a l'info   `m_conversation_fk` = `c_id`

SELECT `m_contenu`,`m_date`, `u_prenom`,`u_nom`  
FROM `user`
JOIN  `message` ON `m_auteur_fk` = `u_id`
WHERE `m_conversation_fk` = 9;




-- 8.Afficher les n° de conversations auxquelles a participé l'utilisateur u_id=3 entre le entre le 2009-02-15 et le 2012-03-03
--! attention 3 pas le bon uID attendre Damien pour les sol données

SELECT `m_conversation_fk` AS `numConv`,`m_date`, `m_auteur_fk`
FROM `message`
WHERE `m_auteur_fk` = 3 AND `m_date` 
--! ORDRE DES DATES IMPORTANT 
BETWEEN '2009-02-15' AND '2012-03-03';


-- DAMIEN 

SELECT `m_conversation_fk` 
FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
WHERE `u_id` = 3  -- ou enlever le JOIN et WHERE direct `m_auteur_fk` = 3
-- CAST enlève le dateTime, plus propre pour réexploter derrière
AND CAST(`m_date` AS DATE)  BETWEEN '2009-02-15' AND '2012-03-03'
--! GROUP ENLEVE DOUBLON
GROUP BY `m_conversation_fk`;



-- 9.Afficher tous les contacts qui ont pris part aux mêmes conversations que l'utilisateur  u_id=8

-- DAMIEN
SELECT `u_id`, `u_login`
FROM `user` ON `m_auteur_fk` = `u_id`
WHERE `m_conversation_fk` IN (
      SELECT `m_conversation_fk`
      FROM `message`
      -- JOIN  `user` ON `m_auteur_fk` = `u_id`
      -- WHERE `u_id`=8
      WHERE `m_auteur_fk`= 8
      GROUP BY `m_conversation_fk`
)
GROUP BY `u_id`
ORDER BY `u_login`;


-- 10.Liste des users avec le total des msg écrits par conversation

--Compte les utilisateurs supprimés de la table user si pas fait une suppression en cascade
-- DAMIEN
SELECT  `m_auteur_fk`, `m_conversation_fk`, COUNT(DISTINCT `m_id`) AS `nbMessage`
FROM `message`
GROUP BY `m_auteur_fk`, `m_conversation_fk`;

--Uniquement les utilisateurs présent dans la table user
-- DAMIEN BONUS
SELECT  `m_auteur_fk`, `m_conversation_fk`, COUNT(DISTINCT `m_id`) AS `nbMessage`
FROM `message`
JOIN user ON m_auteur_fk = u_id
GROUP BY `m_auteur_fk`, `m_conversation_fk`;



-- 11.Afficher tous les messages écrits avant la date de conversation

-- DAMIEN

SELECT *
FROM message
JOIN conversation ON m_conversation_fk = c_id
WHERE m_date < c_date
ORDER BY m_conversation_fk, m_date;


-- 12.Afficher la liste des users qui n'ont jamais pris part à une conversation non terminée

-- DAMIEN demande de l'énoncé
SELECT u_id, u_nom,
FROM user
WHERE u_id NOT IN(
   SELECT u_id
   FROM user
   JOIN message ON u_id = m_auteur_fk
   JOIN conversation ON m_conversation_fk = c_id
   WHERE c_termine = 0
)

-- DAMIEN celui du résultat donné

SELECT u_id, u_nom,
FROM user
WHERE u_id NOT IN(
   SELECT u_id
   FROM user
   JOIN message ON u_id = m_auteur_fk
   JOIN conversation ON m_conversation_fk = c_id
   WHERE c_termine = 1
)



-- 13.Afficher les messages écrits par des admins inscrits en 2010 dans une conversation non terminée

-- DAMIEN
--! pas besoin du rang car on a rang_fk ds user
SELECT *
FROM message
JOIN user ON m_auteur_fk = u_id
JOIN conversation ON m_conversation_fk = c_id
WHERE u_rang_fk = 2 -- admin
AND YEAR(u_date_inscription = '2010')
AND c_termine = 0;


-- 14. 5 messages au hasard d'utilisateurs de rang 'none' de moins de 18 ans qui ont écrit un message comportant 3 fois la lettre 'o'

-- DAMIEN 1
SELECT *
FROM message
JOIN user ON m_auteur_fk = u_id
WHERE u_rang_fk = 3 -- none
WHERE ROUND(DATEDIFF(CURRENT_DATE(), `u_date_naissance`)/365) < 18 
AND m_contenu LIKE '%o%o%o%'
ORDER BY RAND()
LIMIT 5;

-- DAMIEN 2  REGEXP pas plus performant voire plus lent
SELECT *
FROM message
JOIN user ON m_auteur_fk = u_id
WHERE u_rang_fk = 3 -- none
WHERE ROUND(DATEDIFF(CURRENT_DATE(), `u_date_naissance`)/365) < 18 
AND m_contenu REGEXP '(.o*.*){3}' 
ORDER BY RAND()
LIMIT 5;

-- 15.Afficher les messages écrits après l'écriture du dernier message de l'utilisateur 88  dans les conversations auxquelles il a participé

-- 1ère étape  : requête intermédiaire pour avoir ts les derniers messages dans les conversation auxquelles à participé le user 88

SELECT MAX(m_date)
FROM message
WHERE m_auteur_fk = 88
GROUP BY m_conversation_fk
ORDER BY m_conversation_fk

-- requête complete

SELECT * 
FROM message m
WHERE m.m_date > (
   SELECT MAX(message.m_date)
FROM message
WHERE message.m_auteur_fk = 88
)
ORDER BY m.m_conversation_fk, m.m_date DESC

-- SOL ELEVE 

SELECT m_id, m_contenu, m_date, message.m_auteur_fk, message.m_conversation_fk
FROM message
JOIN user ON u_id = m_auteur_fk -- voir si utile, priori non car pas de récup info de user ds SELECT
JOIN (

    SELECT MAX(m_date) AS lastDate
    FROM message
    WHERE m_auteur_fk = 88 

) LastMessageDate ON m_date > LastMessageDate.lastDate

ORDER BY m_conversation_fk, m_date DESC;;